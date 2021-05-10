<?php

namespace App\Http\Controllers;

use App\Models\Sales;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($jenis)
    {

        $title = "Kelola Data User " . $jenis;
        $users = Sales::with('user')->get();

        return view('admin.sales.index', compact('title', 'users', 'jenis'));
    }

    public function store(Request $request)
    {
        // cek limit
        $limit = Sales::all()->count();
        if ($limit == 150) {
            return redirect()->back()->with('alert', 'Sales gagal ditambah. Limit 150 Orang. Hubungi Developer!');
        } else {
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
                    'nomor_hp' => $request->nomor_hp,
                    'created_at' => Carbon::now()
                ];
                $query = Sales::insert($value);
                $user->assignRole('sales');

                if ($query) {
                    return redirect()->back()->with('success', 'User berhasil ditambah');
                } else {
                    return redirect()->back()->with('alert', 'User gagal ditambah');
                }
            } else {
                return redirect()->back()->with('alert', 'User gagal ditambah, Username sudah terdaftar');
            }
        }
    }

    public function edit(Request $request)
    {
        return Sales::find($request->id);
    }

    public function update(Request $request)
    {
        $value = [
            'name' => $request->nama,
            'nomor_hp' => $request->nomor_hp,
        ];
        $query = Sales::where('id', $request->id)
            ->update($value);

        if ($query) {
            return redirect()->back()->with('success', 'User berhasil diubah');
        } else {
            return redirect()->back()->with('alert', 'User gagal diubah');
        }
    }

    public function hapus(Request $request)
    {

        $query = Sales::where('id', $request->id)
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
}
