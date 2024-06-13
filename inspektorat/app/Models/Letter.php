<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Letter extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function irban()
    {
        return $this->belongsTo(User::class, 'irban_penerima', 'id');
    }

    public static function generateNomor($date)
    {
        $number = Letter::orderBy('id', 'DESC')->first()->id ?? Letter::count();
        return str_pad(($number + 1), 5, "0", STR_PAD_LEFT) . '/FD/' . date('dm', strtotime($date)) . substr(date('Y', strtotime($date)), -2);
    }
}
