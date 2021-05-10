<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $title = "Kelola Barang";
        $barang = Barang::all();
        return view('admin.barang.index', compact('barang', 'title'));
    }

    public function store(Request $request)
    {
        // cek limit
        $limit = Barang::all()->count();
        if ($limit == 3) {
            return redirect()->back()->with('alert', 'Barang gagal ditambah. Limit 3 Barang. Hubungi Developer!');
        } else {
            $query = Barang::insert([
                'nama' => $request->nama
            ]);
            if ($query) {
                return redirect()->back()->with('success', 'Barang berhasil ditambah');
            } else {
                return redirect()->back()->with('alert', 'Barang gagal ditambah');
            }
        }
    }

    public function update(Request $request)
    {
        $query = Barang::where('id', $request->id)
            ->update([
                'nama' => $request->nama
            ]);
        if ($query) {
            return redirect()->back()->with('success', 'Barang berhasil diubah');
        } else {
            return redirect()->back()->with('alert', 'Barang gagal diubah');
        }
    }

    public function hapus(Request $request)
    {
        $query = Barang::where('id', $request->id)
            ->delete();

        if ($query) {
            return redirect()->back()->with('success', 'Barang berhasil dihapus');
        } else {
            return redirect()->back()->with('alert', 'Barang gagal dihapus');
        }
    }
}
