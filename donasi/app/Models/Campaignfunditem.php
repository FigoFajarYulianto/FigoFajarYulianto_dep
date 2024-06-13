<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaignfunditem extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function campaign_fund()
    {
        return $this->belongsTo(Campaignfund::class);
    }

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function withdrawal()
    {
        return $this->belongsTo(Withdrawal::class);
    }

    public static function generateInv($code, $date)
    {
        $number = Campaignfunditem::orderBy('no_transaksi', 'DESC')->first()->id ?? 0;
        return str_pad(($number + 1), 5, "0", STR_PAD_LEFT) . '/' . $code . '/' . date('dm', strtotime($date)) . substr(date('Y', strtotime($date)), -2);
    }
}
