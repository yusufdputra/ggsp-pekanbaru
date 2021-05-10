<?php

namespace App\Http\Controllers;

use App\Models\Agen;
use App\Models\Sales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeringkatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        
        $title = "Peringkat Outlet";
        
        $users = Agen::with('kabupaten')
        ->orderBy('poin', 'DESC')
        ->get();


        $peringkat = 0;
        foreach ($users as $key => $value) {
            if (Auth::id() == $value['id_user']) {
                $peringkat = $key+1;
            }
        }
        
        return view('admin.peringkat.index', compact('title', 'users', 'peringkat'));
    }
}
