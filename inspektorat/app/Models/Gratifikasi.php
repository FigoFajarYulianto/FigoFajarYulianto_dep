<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gratifikasi extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }



    public function status()
    {
        return $this->belongsTo(Categorystatus::class);
    }



    public function desa()
    {
        return $this->belongsTo(Desa::class);
    }
}