<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function desas()
    {
        return $this->hasMany(Desa::class);
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