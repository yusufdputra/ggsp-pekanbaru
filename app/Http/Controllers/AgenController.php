<?php

namespace App\Http\Controllers;

use App\Models\Agen;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Provinsi;
use App\Models\Sales;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class AgenController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $jenis = "Agen";
        $title = "Kelola Data User Outlet";
        // $provinsi = Provinsi::all();
        $users = Agen::with('user', 'kelurahan', 'kecamatan', 'kabupaten', 'provinsi')->get();

        return view('admin.agen.index', compact('title', 'users', 'jenis'));
    }

    public function tambah()
    {
        $jenis = "Agen";
        $title = "Tambah Data Outlet";
        $provinsi = Provinsi::all();

        return view('admin.agen.tambah', compact('title', 'provinsi', 'jenis'));
    }

    public function store(Request $request)
    {
        // cek username
        $cek = User::where('username', $request->username);
        if (!$cek->exists()) {
            $user = User::create([
                'username' => $request->username,
                'password' => bcrypt($request->password),
            ]);

            $value = [
                'id_user' => $user->id,
                'name' => $request->nama,
                'id_provinsi' => $request->provinsi,
                'id_kabupaten' => $request->kabupaten,
                'id_kecamatan' => $request->kecamatan,
                'id_kelurahan' => $request->kelurahan,
                'kode_outlet' => $request->kode_outlet,
                'ggsp_type' => $request->ggsp_type,
                'jenis_toko' => $request->jenis_toko,
                'pic_outlet' => $request->pic_outlet,
                'nomor_hp' => $request->no_hp,
                'nama_jalan' => $request->nama_jalan,
                'created_at' => Carbon::now()
            ];
            $query = Agen::insert($value);
            $user->assignRole('agen');

            if ($query) {
                return redirect('agen')->with('success', 'User berhasil ditambah');
            } else {
                return redirect()->back()->with('alert', 'User gagal ditambah');
            }
        } else {
            return redirect()->back()->with('alert', 'User gagal ditambah, Username sudah terdaftar');
        }
    }

    public function edit($id)
    {
        $jenis = "Agen";
        $title = "Edit Data Outlet";
        $user = Agen::where('id', $id)->with('user')->get();
        $provinsi = Provinsi::all();
        $kabupatens = Kabupaten::where('id_prov', $user[0]['id_provinsi'])->get();
        $kecamatan = Kecamatan::where('id_kab', $user[0]['id_kabupaten'])->get();
        $kelurahan = Kelurahan::where('id_kec', $user[0]['id_kecamatan'])->get();

        return view('admin.agen.edit', compact('title', 'user', 'jenis', 'provinsi', 'kabupatens', 'kecamatan', 'kelurahan'));
    }

    public function update(Request $request)
    {
        $cek = User::where('username', $request->username);
        if (!$cek->exists()) {
            $value = [
                'name' => $request->nama,
                'id_provinsi' => $request->provinsi,
                'id_kabupaten' => $request->kabupaten,
                'id_kecamatan' => $request->kecamatan,
                'id_kelurahan' => $request->kelurahan,
                'kode_outlet' => $request->kode_outlet,
                'ggsp_type' => $request->ggsp_type,
                'jenis_toko' => $request->jenis_toko,
                'pic_outlet' => $request->pic_outlet,
                'nomor_hp' => $request->no_hp,
                'nama_jalan' => $request->nama_jalan
            ];
            $query = Agen::where('id', $request->id_agen)
                ->update($value);

            // update username
            User::where('id', $request->id_user)->update([
                'username' => $request->username
            ]);

            if ($query) {
                return redirect('agen')->with('success', 'User berhasil diubah');
            } else {
                return redirect()->back()->with('alert', 'User gagal diubah');
            }
        } else {
            return redirect()->back()->with('alert', 'User gagal diubah, Username sudah terdaftar');
        }
    }

    public function hapus(Request $request)
    {



        $query = Agen::where('id', $request->id)
            ->delete();


        if ($query) {
            User::where('id', $request->id_user)->delete();
            return redirect()->back()->with('success', 'Berhasil menghapus user');
        } else {
            return redirect()->back()->with('alert', 'Gagal menghapus user');
        }
    }

    public function resetpw(Request $request)
    {
        $query = User::where('id', $request->id)
            ->update([
                'password' => bcrypt($request->password)
            ]);

        if ($query) {

            return redirect()->back()->with('success', 'Password User berhasil diubah');
        } else {
            return redirect()->back()->with('alert', 'Password User gagal diubah');
        }
    }

    // ajax
    public function GetAgen($id_kel)
    {
        return Agen::where('id_kelurahan', $id_kel)
            // ->where('id_sales', null)
            ->get();
    }
    public function GetAgenById($id)
    {
        return Agen::where('id', $id)->with('user')->get();
    }
}
