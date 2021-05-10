<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agen extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'id_user');
    }

    public function kelurahan()
    {
        return $this->hasOne(Kelurahan::class, 'id_kel', 'id_kelurahan');
    }
    public function kecamatan()
    {
        return $this->hasOne(Kecamatan::class, 'id_kec', 'id_kecamatan');
    }
    public function kabupaten()
    {
        return $this->hasOne(Kabupaten::class, 'id_kab', 'id_kabupaten');
    }
    public function provinsi()
    {
        return $this->hasOne(Provinsi::class, 'id_prov', 'id_provinsi');
    }
    public function sales()
    {
        return $this->hasOne(User::class, 'id', 'id_sales');
    }
    public function kedatangan()
    {
        return $this->belongsToMany(Kedatangan::class);
    }
}
