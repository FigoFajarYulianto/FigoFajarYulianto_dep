<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = [];

    public function campaigns()
    {
        return $this->hasMany(Campaign::class);
    }

    public function campaigns_sidebar()
    {
        return $this->hasMany(Campaign::class)->where('waktu_tenggat', '>=', date_create(date('Y-m-d')))->where('status_id', 2);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source'    => 'name'
            ]
        ];
    }
}
