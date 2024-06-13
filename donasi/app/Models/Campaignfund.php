<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaignfund extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function campaign_fund_items()
    {
        return $this->hasMany(Campaignfunditem::class);
    }

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }
}
