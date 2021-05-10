<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kedatangan extends Model
{
    use HasFactory;
    public function sales()
    {
        return $this->hasOne(Sales::class, 'id_user', 'id_sales');
    }
    public function agen()
    {
        return $this->hasOne(Agen::class, 'id_user', 'id_agen');
    }
    public function pembelian()
    {
        return $this->belongsToMany(Pembelian::class);
    }
}
