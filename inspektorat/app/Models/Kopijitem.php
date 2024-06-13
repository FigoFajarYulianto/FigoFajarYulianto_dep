<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kopijitem extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function kopij()
    {
        return $this->belongsTo(Kopij::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
