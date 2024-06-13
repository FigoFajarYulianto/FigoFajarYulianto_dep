<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kopij extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function status()
    {
        return $this->belongsTo(Categorystatus::class);
    }

    public function kopijitems()
    {
        return $this->hasMany(Kopijitem::class)->latest();
    }

    public static function generateNomor($date)
    {
        $number = Kopij::orderBy('id', 'DESC')->first()->id ?? Kopij::count();
        return str_pad(($number + 1), 5, "0", STR_PAD_LEFT) . '/KOPI-J/' . date('dm', strtotime($date)) . substr(date('Y', strtotime($date)), -2);
    }
}
