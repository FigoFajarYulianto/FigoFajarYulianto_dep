<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Program extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = [];

    public function pengawasan()
    {
        // 1 category n posts pengawasan
        return $this->hasMany(Pengawasan::class);
    }

    public function posts()
    {
        // 1 category n posts
        return $this->hasMany(Post::class);
    }

    public function categories()
    {
        // 1 category n posts
        return $this->hasMany(Category::class);
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