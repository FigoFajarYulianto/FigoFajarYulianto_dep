<?php

namespace App\Http\Controllers\Backs;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\Kecamatan;
use App\Models\LaporanDarurat;
use App\Models\Categorystatus;
use Illuminate\Http\Request;
use App\Helpers\WhatsApp;
use App\Models\User;
use App\Models\Walog;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanDaruratController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.laporandarurats', [
            'laporandarurats'  => LaporanDarurat::latest()->get(),
            'title_bar' => 'Laporan Pengaduan'
        ]);
    }

    public function create()
    {
        return view('dashboard.laporandaruratscreate', [
            'kecamatans'    => Kecamatan::orderBy('name', 'ASC')->get(),
            'title_bar' => 'Buat Laporan Pengaduan'

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $data = $request->validate([
            'name' => ['required', 'min:2', 'max:255'],
            'telepon' => ['required', 'min:11', 'max:12'],
            'kejadian' => ['required', 'min:4', 'max:255'],
            'hari' => ['required', 'min:4', 'max:255'],
            'tanggal'      => [''],
            'pukul'      => [''],
            'nik'      => ['required'],
            'judul'      => ['required'],
            'alamat'      => ['required'],
            'kecamatan_id'      => ['required'],
            'desa_id'      => ['required'],
            'la_latitude'      => [''],
            'la_longitude'      => [''],
            'kronologi'      => ['required', 'min:4', 'max:255'],
            'material'      => [''],
            'korban'      => [''],
            'lainlain'      => [''],
            'upaya'      => [''],
            'personil'      => [''],
            'terlibat'      => [''],
            'kendala'      => [''],
            'rekomendasi'      => [''],
            'penutup'      => [''],

        ]);

        LaporanDarurat::create($data);

        return redirect('/dashboard/laporandarurats')->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LaporanDarurat  $laporandarurat
     * @return \Illuminate\Http\Response
     */
    public function show(LaporanDarurat $laporandarurat)
    {
        return response()->json($laporandarurat);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LaporanBencana  $laporandarurats
     * @return \Illuminate\Http\Response
     */
    public function edit(LaporanDarurat $laporandarurat)
    {
        return view('dashboard.editlaporandarurats', [
            'title_bar' => 'Perbarui Laporan Pengaduan',
            'kecamatans'    => Kecamatan::orderBy('name', 'ASC')->get(),
            'category'      => Categorystatus::orderBy('name', 'ASC')->get(),
            'laporandarurat'    => $laporandarurat
        ]);
    }





    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LaporanDarurat  $laporandarurat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LaporanDarurat $laporandarurat)
    {

        $data = $request->validate([
            'name' => ['required', 'min:2', 'max:255'],
            'telepon' => ['required', 'min:11', 'max:15'],
            'hari' => ['min:4', 'max:255'],

            'alamat'      => ['required'],
            'nik'      => ['required'],
            'judul'      => ['required'],
            'kecamatan_id'      => ['required'],
            'desa_id'      => ['required'],

            'image1' => ['image', 'file', 'max:2048'],
            'image2' => ['image', 'file', 'max:2048'],
            'image3' => ['image', 'file', 'max:2048'],
            'image4' => ['image', 'file', 'max:2048'],

            'status_id'      => [''],
            'deskripsi' => [''],
        ]);



        if ($request->hasFile('image1')) {
            if ($laporandarurat->image1) {
                Storage::delete($laporandarurat->image1);
            }
            $data['image1'] = $request->image1->store('uploads');
        }

        if ($request->hasFile('image2')) {
            if ($laporandarurat->image2) {
                Storage::delete($laporandarurat->image2);
            }
            $data['image2'] = $request->image2->store('uploads');
        }

        if ($request->hasFile('image3')) {
            if ($laporandarurat->image3) {
                Storage::delete($laporandarurat->image3);
            }
            $data['image3'] = $request->image3->store('uploads');
        }


        if ($request->hasFile('image4')) {
            if ($laporandarurat->image4) {
                Storage::delete($laporandarurat->image4);
            }
            $data['image4'] = $request->image4->store('uploads');
        }




        LaporanDarurat::where('id', $laporandarurat->id)->update($data);

        $datalaporandarurat = LaporanDarurat::firstWhere('id', $laporandarurat->id);



        // kirim wa ke Admin
        $admin = User::where('level_id', 1)->get();
        foreach ($admin as $row) {
            $pesanKeAdmin = 'Kpd Yth. ' . $row->name . ' , Pengaduan yang telah disampaikan oleh masyarakat yaitu *' . $datalaporandarurat->kronologi . '* . Sebagai berikut.

*I. Identittas Pengaduan*
   -Nama: ' . $datalaporandarurat->name . '
   -Nik: ' . $datalaporandarurat->nik . '
   -Telepon: ' . $datalaporandarurat->telepon . '

*II. KRONOLOGI*
     -Hari: ' . $datalaporandarurat->hari . '
     -Tanggal: ' . $datalaporandarurat->tanggal . '
     -Pukul: ' . $datalaporandarurat->pukul . '
     -Judul: ' . $datalaporandarurat->judul . '
     -Penjelasan Kejadian: ' . $datalaporandarurat->kronologi . '

*III. LOKASI*
     -Kelurahan: ' . $datalaporandarurat->desa->name . '
     -Kecamatan: ' . $datalaporandarurat->kecamatan->name . '
     -Alamat: ' . $datalaporandarurat->alamat . '

Sudah dilakukan penanganan dengan status  *' . $datalaporandarurat->status->name . ', yaitu ' . $datalaporandarurat->deskripsi  . '*

';

            if ($row->hp) {
                $sendwa = WhatsApp::sendmessage($row->hp, $pesanKeAdmin);
                $walog = [
                    'name'      => $row->name,
                    'number'    => $row->hp,
                    'message'   => $pesanKeAdmin
                ];
                if ($sendwa) {
                    $walog['status'] = true;
                    Walog::create($walog);
                } else {
                    $walog['status'] = false;
                    Walog::create($walog);
                }
            }
        }



        // kirim wa ke Pelapor

        $pesanKeAdmin = 'Kpd Yth. ' . $datalaporandarurat->name . ' , Pengaduan yang anda sampaikan yaitu *' . $datalaporandarurat->kronologi . '* . Sebagai berikut.

*I. Identittas Pelapor*
   -Nama: ' . $datalaporandarurat->name . '
   -Nik: ' . $datalaporandarurat->nik . '
   -Telepon: ' . $datalaporandarurat->telepon . '

*II. KRONOLOGI*
    -Hari: ' . $datalaporandarurat->hari . '
    -Tanggal: ' . $datalaporandarurat->tanggal . '
    -Pukul: ' . $datalaporandarurat->pukul . '
    -Judul: ' . $datalaporandarurat->judul . '
    -Penjelasan Kejadian: ' . $datalaporandarurat->kronologi . '

*III. LOKASI*
     -Kelurahan: ' . $datalaporandarurat->desa->name . '
     -Kecamatan: ' . $datalaporandarurat->kecamatan->name . '
     -Alamat: ' . $datalaporandarurat->alamat . '

Sudah dilakukan penanganan dengan status  *' . $datalaporandarurat->status->name . ', yaitu ' . $datalaporandarurat->deskripsi  . '*

        ';

        if ($datalaporandarurat->telepon) {
            $sendwa = WhatsApp::sendmessage($datalaporandarurat->telepon, $pesanKeAdmin);
            $walog = [
                'name'      => $datalaporandarurat->name,
                'number'    => $datalaporandarurat->telepon,
                'message'   => $pesanKeAdmin
            ];
            if ($sendwa) {
                $walog['status'] = true;
                Walog::create($walog);
            } else {
                $walog['status'] = false;
                Walog::create($walog);
            }
        }


        return redirect('/dashboard/laporandarurats')->with('success', 'Data Berhasil Diperbarui');
    }






    public function detail(LaporanDarurat $laporandarurat)
    {
        return view('dashboard.detaillaporandarurats', [

            'kecamatans'    => Kecamatan::orderBy('name', 'ASC')->get(),
            'laporandarurat'    => $laporandarurat
        ]);
    }

    public function destroy(LaporanDarurat $laporandarurat)
    {

        LaporanDarurat::destroy($laporandarurat->id);
        return back()->with('success', 'Data Berhasil Dihapus');
    }

    public function download(LaporanDarurat $laporandarurat)
    {

        $pdf = Pdf::setPaper('a4', 'potrait')
            ->loadView('dashboard.laporandaruratsdownload', [
                'title_bar'                 => 'Download',
                'laporandarurat'    => $laporandarurat

            ]);
        return $pdf->stream();
    }

    public function download1()
    {

        $pdf = Pdf::setPaper('a4', 'landscape')
            ->loadView('dashboard.laporandaruratsDownload1', [
                'title_bar'                 => 'Download',
                'laporandarurats'    => LaporanDarurat::latest()->get()

            ]);
        return $pdf->stream();
    }
}
