<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory, Sluggable;

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
        $query->where('status_id', 2);

        // menggunakan when arrow function
        $query->when(
            $filters['q'] ?? false,
            fn ($query, $search) => $query->where('title', 'like', '%' . $search . '%')->orWhere('body', 'like', '%' . $search . '%')
        );

        // whereHas menggunakan nama function table relationship
        $query->when(
            $filters['postcategory'] ?? false,
            fn ($query, $postcategory) => $query->whereHas('postcategory', fn ($query) => $query->where('slug', $postcategory))
        );

        $query->when(
            $filters['author'] ?? false,
            fn ($query, $author) => $query->whereHas('user', fn ($query) => $query->where('username', $author))
        );
    }

    public function postcategory()
    {
        // 1 posts 1 postcategory
        return $this->belongsTo(Postcategory::class);
    }

    public function user()
    {
        // 1 posts 1 user
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        // 1 posts n comments
        return $this->hasMany(Comment::class);
    }

    public function status()
    {
        // 1 posts n 1 status
        return $this->belongsTo(Status::class);
    }
}
