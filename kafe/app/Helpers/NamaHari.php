<?php

namespace App\Helpers;

class NamaHari
{

    public static function format($tanggal)
    {
        if ($tanggal) {
            $day = date('D', strtotime($tanggal));
        } else {
            $day = date('D', strtotime(date('Y-m-d')));
        }

        $dayLists = [
            'Sun' => 'Minggu',
            'Mon' => 'Senin',
            'Tue' => 'Selasa',
            'Wed' => 'Rabu',
            'Thu' => 'Kamis',
            'Fri' => 'Jumat',
            'Sat' => 'Sabtu',
        ];

        return $dayLists[$day];
    }
}
