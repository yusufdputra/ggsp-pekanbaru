<?php

namespace App\Http\Controllers;

use App\Models\Agen;
use App\Models\Kedatangan;
use App\Models\Sales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KehadiranController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $title = "Kehadiran Sales";

        $sales = Sales::all();
        $agen = Agen::all();


        if (Auth::user()->roles[0]['name'] == 'sales') {
            $kehadiran = Kedatangan::with('agen', 'sales')
                ->where('id_sales', Auth::id())
                ->where('selesai', 1)
                ->get();
        } else if (Auth::user()->roles[0]['name'] == 'admin') {
            $kehadiran = Kedatangan::with('agen', 'sales')
                ->where('selesai', 1)
                ->get();
        }

        return view('admin.kehadiran.index', compact('kehadiran', 'title', 'sales', 'agen'));
    }
}
