<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;

class Section extends Model
{
    use HasFactory, SoftDeletes, Sluggable;

    protected $guarded = [];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source'    => 'name'
            ]
        ];
    }

    public static function getSection($slug)
    {
        return Section::where(['slug' => $slug, 'status' => 1])->first();
    }
}