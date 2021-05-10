<?php

namespace App\Http\Controllers;

use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use Illuminate\Http\Request;

class DaerahController extends Controller
{
    public function GetKabupaten($id_prov)
    {
        return Kabupaten::where('id_prov', $id_prov)->get();
    }
    public function GetKecamatan($id_kab)
    {
        return Kecamatan::where('id_kab', $id_kab)->get();
    }
    public function GetKelurahan($id_kec)
    {
        return Kelurahan::where('id_kec', $id_kec)->get();
    }
}
