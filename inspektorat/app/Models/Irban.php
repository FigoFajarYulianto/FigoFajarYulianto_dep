<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Irban extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function irbanwilayah()
    {
        return $this->hasMany(Irbanwilayah::class);
    }
}
