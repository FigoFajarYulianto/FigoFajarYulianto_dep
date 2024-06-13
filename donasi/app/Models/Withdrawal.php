<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function campaignfunditem()
    {
        return $this->belongsTo(Campaignfunditem::class);
    }

    public function funditem()
    {
        return $this->belongsTo(Funditem::class);
    }
}
