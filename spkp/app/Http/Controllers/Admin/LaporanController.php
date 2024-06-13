<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\WPGenerator;
use App\Models\Kandidat;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()

    {

        $data = WPGenerator::weight_product();
        $penerima = Kandidat::all();
        arsort($data['v']);

        foreach ($penerima as $p) {
            if (array_key_exists($p->id, $data['v'])) {
                $data['v'][$p->id] = $p->nama . "|" . $data['v'][$p->id];
            }
        }
        // $pdf = PDF::loadView('laporan.', compact('data', 'penerima'));
        // return $pdf->stream('laporan_karyawan_terbaik_' . date('Y-m-d_H-i-s') . '.pdf');

        $pdf = Pdf::setPaper('a4', 'potrait')
            ->loadView('admin.laporan', [
                'title_bar'                 => 'Download',
                'data'    => $data,
                'penerima' => $penerima

            ]);
        return $pdf->stream();
    }
}