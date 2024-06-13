<?php

namespace App\Http\Controllers\Admin;

use App\Models\Nilai;
use App\Models\Kandidat;
use App\Models\Kriteria;
use App\Models\WPGenerator;
use Illuminate\Http\Request;
use App\Models\RekapKandidat;
use App\Http\Controllers\Controller;
use App\Models\RekapWPGenerator;
use RealRashid\SweetAlert\Facades\Alert;

class RekapPerhitunganController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function calculate()
    {
        if (request(['periode'])) {
            if (request(['periode'])['periode'] != '') {
                $kandidat = RekapKandidat::filter(request(['periode']))
                    ->orderBy('id', 'DESC')
                    ->latest()
                    ->paginate(50);
            } else {
                $kandidat = RekapKandidat::all();
            }
        } else {
            $kandidat = RekapKandidat::all();
        }

        $data = RekapWPGenerator::weight_product();
        $kriteria = Kriteria::all();

        return view('admin.rekap_calculate')->with([
            'kriteria' => $kriteria,
            'data' => $data,
            'penerima' => $kandidat,
            'periode' => request(['periode'])['periode'] ?? '',
        ]);
    }
}
