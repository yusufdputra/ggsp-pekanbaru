<?php

namespace App\Http\Controllers;

use App\Models\Agen;
use App\Models\Kedatangan;
use App\Models\Pembelian;
use App\Models\Provinsi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;

class EntriAgenController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $title = "Kelola Data Pembelian";
        $kedatangan = Kedatangan::with('agen', 'sales')
            ->where('id_sales', Auth::id())
            ->where('selesai', 0)
            ->get();
        return view('sales.agen.index', compact('title', 'kedatangan'));
    }

    public function tambah()
    {
        $title = "Tambah Data Pembelian";
        $provinsi = Provinsi::all();
        return view('sales.agen.tambah', compact('title', 'provinsi'));
    }

    public function store(Request $request)
    {
        // $validatedData = $request->validate([
        //     'file_upload.*' => 'image|mimes:jpg,png,jpeg|max:3062',
        // ]);
        // if ($validatedData == true) {
            // olah file
            // get nama file
            try {


                if ($request->file_upload == null) {
                    $file_path = null;
                } else {
                    $file = $request->file('file_upload');
                    $file_name = time() . '_' . $file->getClientOriginalName();
                    $file_path = $file->storeAs('uploads', $file_name, 'public');

                    //Resize image here
                    // $thumbnailpath = public_path('storage/uploads/' . $file_name);
                    // $img = Image::make($thumbnailpath)->resize(800, 300, function ($constraint) {
                    //     $constraint->aspectRatio();
                    // });
                    // $img->save($thumbnailpath);
                }

                $query = Kedatangan::insert([
                    'id_sales' => Auth::id(),
                    'id_agen' => $request->id_agen,
                    'foto_path_sales' => $file_path,
                    'selesai' => 0
                ]);


                if ($query) {
                    return redirect('entri')->with('success', 'berhasil ditambah');
                } else {
                    return redirect()->back()->with('alert', 'gagal ditambah');
                }
            } catch (\Throwable $th) {
                return redirect()->back()->with('alert', 'gagal ditambah');
            }
        // } else {
        //     return redirect()->back()->with('alert', $validatedData);
        // }
    }
}
