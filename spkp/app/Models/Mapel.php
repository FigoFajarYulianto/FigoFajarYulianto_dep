<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    use HasFactory;

    protected $table = 'mapel';

    protected $guarded = [];
    const BENEFIT = 'benefit';
    const COST = 'cost';


    public function ujianSiswa()
    {
        return $this->hasMany(UjianSiswa::class);
    }
    public function ujian()
    {
        return $this->belongsTo(Ujian::class);
    }
}