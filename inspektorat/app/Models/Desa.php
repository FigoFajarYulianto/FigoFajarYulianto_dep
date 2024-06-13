<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desa extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }

    public function bencana()
    {
        return $this->hasMany(Bencana::class);
    }

    // public function officers()
    // {
    //     return $this->hasMany(Officer::class);
    // }

    // public function reports()
    // {
    //     return $this->hasMany(Report::class);
    // }
}