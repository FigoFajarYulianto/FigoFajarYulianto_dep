<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zakattransactionitem extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function generateInv($code, $date)
    {
        $number = Zakattransactionitem::orderBy('no_transaksi', 'DESC')->first()->id ?? 0;
        return str_pad(($number + 1), 5, "0", STR_PAD_LEFT) . '/' . $code . '/' . date('dm', strtotime($date)) . substr(date('Y', strtotime($date)), -2);
    }

    public function zakat()
    {
        return $this->belongsTo(Zakat::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
