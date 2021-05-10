<?php

namespace App\Http\Controllers;

use App\Models\Agen;
use App\Models\Barang;
use App\Models\Kedatangan;
use App\Models\Pembelian;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;

class PembelianController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $title = "Pembelian Produk";
        // $id_user = Agen::select('id')
        //     ->where('id_user', Auth::id())
        //     ->first();


        $kedatangan = Kedatangan::with('sales')
            ->where('id_agen', Auth::id())
            ->where('selesai', 0)
            ->get();


        return view('agen.pembelian.index', compact('title', 'kedatangan'));
    }

    public function tambah($id_kedatangan)
    {
        $title = "Pembelian Produk";
        $barangs = Barang::all();

        return view('agen.pembelian.tambah', compact('title', 'barangs', 'id_kedatangan'));
    }

    public function store(Request $request)
    {
        try {
            // get barang
            $barangs = Barang::all();

            $poin = 0;

            $arr_idBarang = array();
            $arr_getStok = array();
            $arr_getBelanja = array();
            $arr_getDisplay = array();
            $arr_getDisOther = array();
            $arr_getPackKosong = array();

            foreach ($barangs as $key => $value) {
                $id_barang = $value->id;
                $stok = $request->stok[($key + 1)];
                $stok_poin = $request->poin_stok[($key + 1)];
                $GetStok = compact('stok', 'stok_poin');

                $belanja = $request->belanja[($key + 1)];
                $belanja_poin = $request->poin_belanja[($key + 1)];
                $GetBelanja = compact('belanja', 'belanja_poin');

                $display = $request->display[($key + 1)];
                $display_poin = $request->poin_display[($key + 1)];
                $GetDisplay = compact('display', 'display_poin');

                $dis_other = $request->dis_other[($key + 1)];
                $dis_other_poin = $request->poin_dis_other[($key + 1)];
                $GetDisOther = compact('dis_other', 'dis_other_poin');

                $pack_kosong = $request->pack_kosong[($key + 1)];
                $pack_kosong_poin = $request->poin_pack_kosong[($key + 1)];
                $GetPackKosong = compact('pack_kosong', 'pack_kosong_poin');

                // set to array
                $arr_idBarang[$key] = $request->id_barang[$key + 1];
                $arr_getStok[$key] = $GetStok;
                $arr_getBelanja[$key] = $GetBelanja;
                $arr_getDisplay[$key] = $GetDisplay;
                $arr_getDisOther[$key] = $GetDisOther;
                $arr_getPackKosong[$key] = $GetPackKosong;

                // jumlahkan poin
                $poin = $poin + (int)$stok_poin + (int)$belanja_poin + (int)$display_poin + (int)$dis_other_poin + (int)$pack_kosong_poin;
            }

            $file_path = null;
            // $file = $request->file('foto_display');
            $files = $request->file();
            if ($files == null) {
                $arr_getFoto = null;
            } else {

                // dd(($value[key($value)])->getClientOriginalName());
                // $file = $request->file('foto_display');

                $file_name = time() . '_' . $files['foto_display']->getClientOriginalName();
                $file_path = $files['foto_display']->storeAs('uploads', $file_name, 'public');

                // resize img
                //Resize image here
                $thumbnailpath = public_path('storage/uploads/' . $file_name);
                $img = Image::make($thumbnailpath)->resize(800, 300, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $img->save($thumbnailpath);

                
                // $file_name = time() . '_' . $value->getClientOriginalName();
                // $tujuan_upload = 'storage';
                // $value->move($tujuan_upload, $file_name);
                $arr_getFoto = $file_path;
            }






            Pembelian::insert([
                'id_agen' => Auth::id(),
                'id_barang' => serialize($arr_idBarang),
                'week' => Carbon::now()->weekOfYear,
                'created_at' => Carbon::now(),
                'id_kedatangan' => $request->id_kedatangan,
                'stok' => serialize($arr_getStok),
                'belanja' => serialize($arr_getBelanja),
                'display' => serialize($arr_getDisplay),
                'display_other' => serialize($arr_getDisOther),
                'pack_kosong' => serialize($arr_getPackKosong),
                'foto_display' => ($arr_getFoto)
            ]);

            // jumlahkan dengan poin sebelumnya
            $poin_agen = Agen::select('poin')
                ->where('id_user', Auth::id())
                ->first();


            $q = Agen::where('id_user', Auth::id())
                ->update([
                    'poin' => (int)$poin_agen['poin'] + $poin
                ]);
            if ($q) {
                Kedatangan::where('id', $request->id_kedatangan)
                    ->update([
                        'selesai' => 1
                    ]);
                return redirect()->route('pembelian.index')->with('success', 'Pembelian Berhasil Ditambah');
            } else {
                return redirect()->back()->with('alert', 'Pembelian Gagal Ditambah');
            }
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('alert', 'Pembelian Gagal Ditambah' . $th);
        }
    }

    public function pembelian($id_agen)
    {
        // get nama toko
        $nama_toko = Agen::select('name')->where('id_user', $id_agen)->first();
        $title = "Riwayat Pembelian Toko " . strtoupper($nama_toko['name']);
        $pembelian = Pembelian::with('kedatangan')->where('id_agen', $id_agen)->get();
        $barang = Barang::all();

        return view('admin.pembelian.riwayat', compact('title', 'pembelian', 'barang'));
    }
}
