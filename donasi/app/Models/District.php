<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function campaigns()
    {
        return $this->hasMany(Campaign::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function subdistricts()
    {
        return $this->hasMany(Subdistrict::class);
    }

    public function zakatcollectionunit()
    {
        return $this->hasMany(Zakatcollectionunit::class);
    }
}
