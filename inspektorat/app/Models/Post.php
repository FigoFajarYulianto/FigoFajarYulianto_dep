<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes, Sluggable;

    protected $guarded = [];

    // public function getRouteKeyName()
    // {
    //     return 'slug';
    // }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source'    => 'title'
            ]
        ];
    }

    public function scopeFilter($query, array $filters)
    {
        $query->where('status', 1);

        // menggunakan when arrow function
        $query->when(
            $filters['q'] ?? false,
            fn ($query, $search) => $query->where('title', 'like', '%' . $search . '%')->orWhere('body', 'like', '%' . $search . '%')
        );

        // whereHas menggunakan nama function table relationship
        $query->when(
            $filters['category'] ?? false,
            fn ($query, $category) => $query->whereHas('category', fn ($query) => $query->where('slug', $category))
        );

        $query->when(
            $filters['author'] ?? false,
            fn ($query, $author) => $query->whereHas('user', fn ($query) => $query->where('username', $author))
        );
    }

    public function category()
    {
        // 1 posts 1 category
        return $this->belongsTo(Category::class)->with('program');
    }

    public function program()
    {
        // 1 posts 1 program
        return $this->belongsTo(Program::class);
    }

    public function user()
    {
        // 1 posts 1 user
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        // 1 posts n tags
        return $this->hasMany(Tag::class);
    }

    public function comments()
    {
        // 1 posts n comments
        return $this->hasMany(Comment::class);
    }
}