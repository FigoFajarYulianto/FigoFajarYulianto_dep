<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zakat extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = [];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source'    => 'title'
            ]
        ];
    }

    public function zakatfund()
    {
        return $this->belongsTo(Zakatfund::class, 'id', 'zakat_id');
    }

    public function zakattransactionitems()
    {
        return $this->hasMany(Zakattransactionitem::class);
    }
}
