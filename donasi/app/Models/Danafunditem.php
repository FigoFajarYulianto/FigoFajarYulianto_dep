<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Danafunditem extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function generateInv($code, $date)
    {
        $number = Danafunditem::orderBy('no_transaksi', 'DESC')->first()->id ?? 0;
        return str_pad(($number + 1), 5, "0", STR_PAD_LEFT) . '/' . $code . '/' . date('dm', strtotime($date)) . substr(date('Y', strtotime($date)), -2);
    }

    public function dana()
    {
        return $this->belongsTo(Dana::class, 'dana_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class, 'bank_id', 'id');
    }
}
