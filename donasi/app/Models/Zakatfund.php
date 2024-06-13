<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zakatfund extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function zakat()
    {
        return $this->belongsTo(Zakat::class);
    }
}
