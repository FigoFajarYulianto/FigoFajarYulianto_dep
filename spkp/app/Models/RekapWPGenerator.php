<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use App\Models\Kriteria;
use App\Models\Nilai;

class RekapWPGenerator
{
    public static function weight_product()
    {
        $wj = DB::table('kriterias')->sum('bobot');
        $kriteria = Kriteria::all();
        $weight = [];

        foreach ($kriteria as $k) {
            $weight[$k->id] = $k->bobot / $wj;
        }


        $nilai = RekapNilai::orderBy('kandidat_id')->get();
        $penerima = null;
        $s = [];


        $tmp_s = 1;
        $hit = 0;
        $len = count($nilai);
        foreach ($nilai as $n) {
            if ($penerima != $n->kandidat_id) {
                if ($penerima != null) {
                    $tmp = [];
                    $tmp['s'] = $tmp_s;
                    $tmp['penerima'] = $penerima;
                    array_push($s, $tmp);
                }

                $penerima = $n->kandidat_id;
                $tmp_s = 1;
            }

            if ($n->kriteria->atribut == Kriteria::COST) {
                if (array_key_exists($n->kriteria_id, $weight)) {
                    $weight[$n->kriteria_id] = ($weight[$n->kriteria_id] > 0) ? $weight[$n->kriteria_id] * -1 : $weight[$n->kriteria_id];
                }
            }

            $tmp_s *= pow($n->nilai, $weight[$n->kriteria_id]);
            if ($hit == $len - 1) {
                $tmp = [];
                $tmp['s'] = $tmp_s;
                $tmp['penerima'] = $penerima;
                array_push($s, $tmp);
            }
            $hit++;
        }

        $vj = 0;
        foreach ($s as $single_s) {
            $vj += $single_s['s'];
        }
        $v = [];

        foreach ($s as $single_s) {
            $v[$single_s['penerima']] = $single_s['s'] / $vj;
        }

        return [
            'weight' => $weight,
            's' => $s,
            'v' => $v
        ];
    }
}
