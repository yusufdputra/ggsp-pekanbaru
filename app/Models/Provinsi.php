<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    use HasFactory;

    public function kabupaten()
    {
        return $this->belongsToMany(Kabupaten::class);
    }

    public function agen()
    {
        return $this->belongsToMany(Agen::class);
    }
}
