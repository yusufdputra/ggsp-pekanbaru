<?php

namespace App\Http\Controllers;

use App\Models\Agen;
use App\Models\Sales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $title = "Login";
        return view('home', compact('title'));
    }

    public function auth()
    {
        $title = "Dashboard";

        $total_sales = Sales::all()->count();
        // peringkat
        $agen = Agen::with('kabupaten')
        ->orderBy('poin', 'DESC')
        ->get();
        $peringkat = 0;
        foreach ($agen as $key => $value) {
            if (Auth::id() == $value['id_user']) {
                $peringkat = $key+1;
            }
        }
        $total_agen = $agen->count();

        $users = Agen::with('kabupaten', 'sales')
        ->orderBy('poin', 'DESC')
        ->limit(20)
        ->get();

        if (Auth::check()) {
            return view('home', compact('title','users', 'peringkat', 'total_agen', 'total_sales'));
        }
        return view('auth.login', compact('title'));
    }
}
