<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pembelian extends Model
{
    use HasFactory, SoftDeletes;

    
    protected $dates = ['deleted_at'];

    public function sales()
    {
        return $this->hasOne(Sales::class, 'id', 'id_sales');
    }
    public function barang()
    {
        return $this->hasOne(Barang::class, 'id', 'id_barang');
    }
    public function kedatangan()
    {
        return $this->hasOne(Kedatangan::class, 'id', 'id_kedatangan');
    }
    
}
