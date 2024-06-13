<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categorystatus extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function kopijs()
    {
        return $this->hasMany(Kopij::class, 'status_id', 'id');
    }
}
