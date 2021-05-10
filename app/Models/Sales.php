<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sales extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'saless';
    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'id_user');
    }

    public function agen()
    {
        return $this->belongsToMany(Agen::class);
    }

    public function sales()
    {
        return $this->belongsToMany(Sales::class);
    }

    public function pembelian()
    {
        return $this->belongsToMany(Pembelian::class);
    }

    public function kedatangan()
    {
        return $this->belongsToMany(Kedatangan::class);
    }
}
