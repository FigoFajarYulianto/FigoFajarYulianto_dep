<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes, Sluggable;

    protected $guarded = [];

    public function posts()
    {
        // 1 category n posts
        return $this->hasMany(Post::class);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source'    => 'name'
            ]
        ];
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}