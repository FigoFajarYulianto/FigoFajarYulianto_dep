<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kandidat;
use App\Models\Kriteria;
use App\Models\Nilai;
use App\Models\WPGenerator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PerhitunganController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function calculate()
    {
        $data = WPGenerator::weight_product();
        $kriteria = Kriteria::all();
        $penerima = Kandidat::all();

        arsort($data['v']);

        foreach ($penerima as $p) {
            if (array_key_exists($p->id, $data['v'])) {
                $data['v'][$p->id] =  $p->nama . "|" . $data['v'][$p->id];
                // dd($data['v'][$p->id]);
            }
        }


        return view('admin.calculate')->with([
            'kriteria' => $kriteria,
            'data' => $data,
            'penerima' => $penerima,

        ]);
    }
}
