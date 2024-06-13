<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dana extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = [];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source'    => 'name'
            ]
        ];
    }

    public function danacategory()
    {
        return $this->belongsTo(Danacategory::class, 'danacategory_id', 'id');
    }

    public function danafund()
    {
        return $this->belongsTo(Danafund::class, 'dana_id', 'id');
    }

    public function danafunditems()
    {
        return $this->hasMany(Danafunditem::class);
    }
}
