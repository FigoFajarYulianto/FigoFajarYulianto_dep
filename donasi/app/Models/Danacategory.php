<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Danacategory extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function danas()
    {
        return $this->hasMany(Dana::class);
    }
}
