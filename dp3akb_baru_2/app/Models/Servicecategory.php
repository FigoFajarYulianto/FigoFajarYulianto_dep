<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Servicecategory extends Model
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

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function consultations()
    {
        return $this->hasMany(Consultation::class);
    }
}
