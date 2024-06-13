<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RekapKandidat extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $table = 'rekap_kandidat';

    public function nilai()
    {
        return $this->hasMany('App\Models\RekapNilai', 'kandidat_id', 'id');
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function scopeFilter($query, array $filters)
    {
        if ($filters) {
            $periode = $query->where('periode', $filters['periode']);
            return $periode;
        }
    }
}
