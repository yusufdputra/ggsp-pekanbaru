<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    use HasFactory;
    
    public function provinsi()
    {
        return $this->hasOne(Provinsi::class, 'id_prov', 'id_prov');
    }

    public function agen()
    {
        return $this->belongsToMany(Agen::class);
    }
}
