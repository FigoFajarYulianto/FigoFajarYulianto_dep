<?php

namespace App\Http\Controllers\Fronts;

use App\Models\Regulasi;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class RegulasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
            $regulasis    = Regulasi::latest()->paginate(100);

        $title_bar = 'Peraturan';

        return view('fronts.regulasi', compact('regulasis', 'title_bar'));
    }

    public function download(Regulasi $regulasi)
    {
        return response()->download('storage/' . $regulasi->unduh);
    }

    // Pencarian
    public function advance(Request $request)
    {
        $title_bar = 'Peraturan';
        $regulasis     = Regulasi::latest();
        if ($request->peraturan_id) {
            $regulasis = $regulasis->where('peraturan_id', 'LIKE', "%" . $request->peraturan_id . "%");
        }
        if ($request->judul) {
            $regulasis = $regulasis->where('judul', 'LIKE', "%" . $request->judul . "%");
        }
        $regulasis = $regulasis->paginate(100);
        return view('fronts.regulasi', compact('regulasis', 'title_bar'));
    }
}