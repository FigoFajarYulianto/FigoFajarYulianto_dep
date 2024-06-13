<?php

namespace App\Http\Controllers\Backs;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\Kecamatan;
use App\Models\Gratifikasi;
use App\Models\Categorystatus;
use Illuminate\Http\Request;
use App\Helpers\WhatsApp;
use App\Models\User;
use App\Models\Walog;
use Barryvdh\DomPDF\Facade\Pdf;



class GratifikasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.gratifikasis', [
            'gratifikasis'  => Gratifikasi::latest()->get(),
            'title_bar'     => 'Laporan Gratifikasi'
        ]);
    }

    public function create()
    {
        return view('dashboard.gratifikasiscreate', [
            'title_bar'     => 'Buat Laporan Gratifikasi',
            'kecamatans'    => Kecamatan::orderBy('name', 'ASC')->get(),

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

        Gratifikasi::create($data);

        return redirect('/dashboard/gratifikasis')->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gratifikasi  $gratifikasi
     * @return \Illuminate\Http\Response
     */
    public function show(Gratifikasi $gratifikasi)
    {
        return response()->json($gratifikasi);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gratifikasi  $gratifikasi
     * @return \Illuminate\Http\Response
     */
    public function edit(Gratifikasi $gratifikasi)
    {
        return view('dashboard.editgratifikasis', [
            'title_bar' => 'Perbarui Laporan Gratifikasi',
            'kecamatans'    => Kecamatan::orderBy('name', 'ASC')->get(),
            'category'      => Categorystatus::orderBy('name', 'ASC')->get(),
            'gratifikasi'    => $gratifikasi
        ]);
    }





    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gratifikasi  $Gratifikasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gratifikasi $gratifikasi)
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
            if ($gratifikasi->image1) {
                Storage::delete($gratifikasi->image1);
            }
            $data['image1'] = $request->image1->store('uploads');
        }

        if ($request->hasFile('image2')) {
            if ($gratifikasi->image2) {
                Storage::delete($gratifikasi->image2);
            }
            $data['image2'] = $request->image2->store('uploads');
        }

        if ($request->hasFile('image3')) {
            if ($gratifikasi->image3) {
                Storage::delete($gratifikasi->image3);
            }
            $data['image3'] = $request->image3->store('uploads');
        }


        if ($request->hasFile('image4')) {
            if ($gratifikasi->image4) {
                Storage::delete($gratifikasi->image4);
            }
            $data['image4'] = $request->image4->store('uploads');
        }




        Gratifikasi::where('id', $gratifikasi->id)->update($data);

        $datalaporandarurat = Gratifikasi::firstWhere('id', $gratifikasi->id);



        // kirim wa ke Admin
        $admin = User::where('level_id', 1)->get();
        foreach ($admin as $row) {
            $pesanKeAdmin = 'Kpd Yth. ' . $row->name . ' , Gratifikasi yang telah disampaikan oleh masyarakat yaitu *' . $datalaporandarurat->kronologi . '* . Sebagai berikut.

*I. Identittas Pengaduan*
   -Nama: ' . $datalaporandarurat->name . '
   -Nik: ' . $datalaporandarurat->nik . '
   -Telepon: ' . $datalaporandarurat->telepon . '

*II. KRONOLOGI*
     -Hari: ' . $datalaporandarurat->hari . '
     -Tanggal: ' . $datalaporandarurat->tanggal . '
     -Pukul: ' . $datalaporandarurat->pukul . '
     -Judul: ' . $datalaporandarurat->judul . '
     -Penjelasan: ' . $datalaporandarurat->kronologi . '

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

        $pesanKeAdmin = 'Kpd Yth. ' . $datalaporandarurat->name . ' , Gratifikasi yang anda sampaikan yaitu *' . $datalaporandarurat->kronologi . '* . Sebagai berikut.

*I. Identittas Pelapor*
   -Nama: ' . $datalaporandarurat->name . '
   -Nik: ' . $datalaporandarurat->nik . '
   -Telepon: ' . $datalaporandarurat->telepon . '

*II. KRONOLOGI*
    -Hari: ' . $datalaporandarurat->hari . '
-Tanggal: ' . $datalaporandarurat->tanggal . '
    -Pukul: ' . $datalaporandarurat->pukul . '
    -Judul: ' . $datalaporandarurat->judul . '
    -Penjelasan: ' . $datalaporandarurat->kronologi . '

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


        return redirect('/dashboard/gratifikasis')->with('success', 'Data Berhasil Diperbarui');
    }






    // public function detail(LaporanDarurat $laporandarurat)
    // {
    //     return view('dashboard.detaillaporandarurats', [

    //         'kecamatans'    => Kecamatan::orderBy('name', 'ASC')->get(),
    //         'laporandarurat'    => $laporandarurat
    //     ]);
    // }

    public function destroy(Gratifikasi $gratifikasi)
    {

        Gratifikasi::destroy($gratifikasi->id);
        return back()->with('success', 'Data Berhasil Dihapus');
    }

    // public function download(LaporanDarurat $laporandarurat)
    // {

    //     $pdf = Pdf::setPaper('a4', 'potrait')
    //         ->loadView('dashboard.laporandaruratsdownload', [
    //             'title_bar'                 => 'Download',
    //             'laporandarurat'    => $laporandarurat

    //         ]);
    //     return $pdf->stream();
    // }

    // public function download1()
    // {

    //     $pdf = Pdf::setPaper('a4', 'landscape')
    //         ->loadView('dashboard.laporandaruratsDownload1', [
    //             'title_bar'                 => 'Download',
    //             'laporandarurats'    => LaporanDarurat::latest()->get()

    //         ]);
    //     return $pdf->stream();
    // }
}
