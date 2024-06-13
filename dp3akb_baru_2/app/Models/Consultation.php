<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function generateInv($code, $date)
    {
        $number = Consultation::orderBy('id_konsultasi', 'DESC')->first()->id ?? 0;
        return str_pad(($number + 1), 5, "0", STR_PAD_LEFT) . '/' . $code . '/' . date('dm', strtotime($date)) . substr(date('Y', strtotime($date)), -2);
    }

    public function servicecategory()
    {
        return $this->belongsTo(Servicecategory::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
    
    public function consultationreplies()
    {
        return $this->hasMany(Consultationreplies::class)->latest();
    }
}
