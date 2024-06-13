<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function Categoryconsultation()
    {
        return $this->belongsTo(Categoryconsultation::class)->latest();
    }

    public function Consultationreplies()
    {
        return $this->hasMany(Consultationreply::class)->latest();
    }

    public function statusconsultation()
    {
        return $this->belongsTo(Statusconsultation::class)->latest();
    }

    public static function generateInv($date)
    {
        $number = Consultation::orderBy('id', 'DESC')->first()->id;
        return str_pad(($number + 1), 5, "0", STR_PAD_LEFT) . '/CONSUL/' . date('dm', strtotime($date)) . substr(date('Y', strtotime($date)), -2);
    }
}
