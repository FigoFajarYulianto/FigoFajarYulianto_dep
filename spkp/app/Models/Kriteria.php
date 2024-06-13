<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kriteria extends Model
{

    use HasFactory;
    protected $guarded = [];
    const BENEFIT = 'benefit';
    const COST = 'cost';
    protected $table = 'kriterias';
    // protected $fillable = [
    //     'nama',
    //     'atribut',
    //     'bobot',
    //     'keterangan'
    // ];

    public function nilai()
    {
        return $this->hasMany('App\Models\Nilai', 'kriteria_id', 'id');
    }

    public function mapel()
    {
        return $this->belongsTo(Mapel::class);
    }

    public function ujian()
    {
        return $this->belongsTo(Ujian::class);
    }
}
