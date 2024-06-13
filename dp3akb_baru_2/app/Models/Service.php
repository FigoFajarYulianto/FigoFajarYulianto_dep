<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
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

    public function servicecategories()
    {
        return $this->hasMany(Servicecategory::class);
    }

    public function postcategory($postcategory_id)
    {
        return $this->belongsTo(Postcategory::class)->where('id', $postcategory_id);
    }
}
