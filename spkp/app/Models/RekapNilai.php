<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RekapNilai extends Model
{

    use HasFactory;

    protected $guarded = [];
    protected $table = 'rekap_nilai';
    // protected $fillable = [
    //     'kandidat_id',
    //     'kriteria_id',
    //     'nilai'
    // ];
    public function kriteria()
    {
        return $this->belongsTo('App\Models\Kriteria', 'kriteria_id', 'id');
    }
    public function kandidat()
    {
        return $this->belongsTo('App\Models\Kandidat', 'kandidat_id', 'id');
    }
    public function kandidat_found()
    {
        return $this->belongsTo(Kandidat::class, 'kandidat_id', 'id');
    }
}
