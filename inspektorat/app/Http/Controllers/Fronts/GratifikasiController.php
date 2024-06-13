<?php

namespace App\Http\Controllers\Fronts;

use App\Http\Controllers\Controller;
use App\Models\Gratifikasi;
use App\Models\Kecamatan;
use App\Models\User;
use Illuminate\Http\Request;
use App\Rules\ReCaptcha;
use App\Helpers\WhatsApp;
use App\Models\Walog;

class GratifikasiController extends Controller

{
    public function index()
    {
        return view('fronts.gratifikasi', [
            'kecamatans'    => Kecamatan::orderBy('name', 'ASC')->get(),
            'title_bar'    => ('Form Gratifikasi'),

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
            'kejadian' => ['min:4', 'max:255'],
            'hari' => ['required', 'min:4', 'max:255'],
            'tanggal'      => [''],
            'pukul'      => [''],
            'alamat'      => ['required'],
            'kecamatan_id'      => ['required'],
            'desa_id'      => ['required'],
            'la_latitude'      => [''],
            'la_longitude'      => [''],
            'image1' => ['image', 'file', 'max:2048'],
            'image2' => ['image', 'file', 'max:2048'],
            'image3' => ['image', 'file', 'max:2048'],
            'image4' => ['image', 'file', 'max:2048'],
            'kronologi'      => ['min:4', 'max:255'],
            'nik'      => ['min:4', 'max:255'],
            'judul'      => ['min:4', 'max:255'],
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


        $request->validate([
            'g-recaptcha-response'  => ['required', new ReCaptcha]
        ]);

        $data['image1'] = $request->hasFile('image1')  ? $request->image1->store('uploads') : NULL;

        $data['image2'] = $request->hasFile('image2')  ? $request->image2->store('uploads') : NULL;

        $data['image3'] = $request->hasFile('image3')  ? $request->image1->store('uploads') : NULL;

        $data['image4'] = $request->hasFile('image4')  ? $request->image2->store('uploads') : NULL;

        $pelapor['name'] = $request->name;
        $pelapor['telepon'] = $request->telepon;
        $pelapor['kejadian'] = $request->kejadian;
        $pelapor['hari'] = $request->hari;
        $pelapor['nik'] = $request->nik;
        $pelapor['judul'] = $request->judul;
        $pelapor['tanggal'] = $request->tanggal;
        $pelapor['pukul'] = $request->pukul;
        $pelapor['alamat'] = $request->alamat;
        $pelapor['kecamatan_id'] = $request->kecamatan_id;
        $pelapor['desa_id'] = $request->desa_id;
        $pelapor['kronologi'] = $request->kronologi;
        $pelapor['status_id'] = '2';
        // $queryLaporan = LaporanDarurat::create($pelapor);
        // LaporanDarurat::create($data);

        $data['status_id'] = '2';

        $queryLaporan = Gratifikasi::create($data);

        $dataLaporan = Gratifikasi::firstWhere('id', $queryLaporan->id);



        // kirim wa ke Admin
        $admin  = User::where('level_id', 1)->get();
        foreach ($admin as $row) {
            $pesanKeAdmin = 'Kpd Yth. ' . $row->name . ' , Mohon ijin dengan hormat, melaporkan Pengaduan yang disampaikan oleh masyarakat yaitu Pengaduan ' . $dataLaporan->judul . ' . sebagai berikut.

*I. Identittas Pengadu*
   -Nama: ' . $dataLaporan->name . '
   -NIK: ' . $dataLaporan->nik . '
   -Telepon: ' . $dataLaporan->telepon . '

*II. KRONOLOGI*
    -Hari: ' . $dataLaporan->hari . '
    -Tanggal: ' . $dataLaporan->tanggal . '
    -Pukul: ' . $dataLaporan->pukul . '
    -Judul: ' . $dataLaporan->judul . '
    -Penjelasan: ' . $dataLaporan->kronologi . '

*III. LOKASI*
     -Kelurahan: ' . $dataLaporan->desa->name . '
     -Kecamatan: ' . $dataLaporan->kecamatan->name . '
     -Alamat: ' . $dataLaporan->alamat . '';

            $media = url('/storage/' . $dataLaporan->image1) . '';

            if ($row->hp) {
                $sendwa = WhatsApp::sendmedia($row->hp, $media, $pesanKeAdmin);
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


        // kirim wa ke Pengadu
        $pesanKeAdmin = 'Kpd Yth. ' . $dataLaporan->name . ' , Gratifikasi yang telah anda sampaikan telah tertampung yaitu dengan gratifikasi ' . $dataLaporan->judul . ' . sebagai berikut.

 *I. Identittas Pengadu*
    -Nama: ' . $dataLaporan->name . '
    -NIK: ' . $dataLaporan->nik . '
    -Telepon: ' . $dataLaporan->telepon . '

 *II. KRONOLOGI*
    -Hari: ' . $dataLaporan->hari . '
    -Tanggal: ' . $dataLaporan->tanggal . '
    -Pukul: ' . $dataLaporan->pukul . '
    -Judul: ' . $dataLaporan->judul . '
    -Penjelasan: ' . $dataLaporan->kronologi . '

*III. LOKASI*
    -Kelurahan: ' . $dataLaporan->desa->name . '
    -Kecamatan: ' . $dataLaporan->kecamatan->name . '
    -Alamat: ' . $dataLaporan->alamat . '';


        $media = url('/storage/' . $dataLaporan->image1) . '';

        if ($dataLaporan->telepon) {
            $sendwa = WhatsApp::sendmedia($dataLaporan->telepon, $media, $pesanKeAdmin);
            $walog = [
                'name'      => $dataLaporan->name,
                'number'    => $dataLaporan->telepon,
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

        // kirim wa ke kaban
        // $kaban = User::where('level_id', 5)->get();
        // foreach ($kaban as $row) {
        //     $pesanKeAdmin = 'Kpd Yth. ' . $row->name . ' , Mohon ijin dengan hormat, melaporkan kejadian darurat yang disampaikan oleh masyarakat yaitu kejadian ' . $dataLaporan->kejadian . ' . sebagai berikut.

        // *I. Identittas Pelapor*
        // -Nama: ' . $dataLaporan->name . '
        // -Telepon: ' . $dataLaporan->telepon . '

        // *II. KRONOLOGI*
        // -Hari: ' . $dataLaporan->hari . '
        // -Tanggal: ' . $dataLaporan->tanggal . '
        // -Pukul: ' . $dataLaporan->pukul . '
        // -Kronologi Kejadian: ' . $dataLaporan->kronologi . '

        // *III. LOKASI*
        // -Kelurahan: ' . $dataLaporan->desa->name . '
        // -Kecamatan: ' . $dataLaporan->kecamatan->name . '
        // -Lokasi: ' . $dataLaporan->alamat . '

        // Untuk melihat lebih detailnya bisa akses link berikut : ' . url('/laporanwargas/' . $dataLaporan->id . '/detail') . '';

        //     $media = url('/storage/' . $dataLaporan->image1) . '';


        //     if ($row->hp) {
        //         $sendwa = WhatsApp::sendmedia($row->hp, $media, $pesanKeAdmin);
        //         $walog = [
        //             'name'      => $row->name,
        //             'number'    => $row->hp,
        //             'message'   => $pesanKeAdmin
        //         ];

        //         if ($sendwa) {
        //             $walog['status'] = true;
        //             Walog::create($walog);
        //         } else {
        //             $walog['status'] = false;
        //             Walog::create($walog);
        //         }
        //     }
        // }


        // kirim wa ke Sekban
        // $sekban = User::where('level_id', 6)->get();
        // foreach ($sekban as $row) {
        //     $pesanKeAdmin = 'Kpd Yth. ' . $row->name . ' , Mohon ijin dengan hormat, melaporkan kejadian darurat yang disampaikan oleh masyarakat yaitu kejadian ' . $dataLaporan->kejadian . ' . sebagai berikut.

        // *I. Identittas Pelapor*
        // -Nama: ' . $dataLaporan->name . '
        // -Telepon: ' . $dataLaporan->telepon . '

        // *II. KRONOLOGI*
        // -Hari: ' . $dataLaporan->hari . '
        // -Tanggal: ' . $dataLaporan->tanggal . '
        // -Pukul: ' . $dataLaporan->pukul . '
        // -Kronologi Kejadian: ' . $dataLaporan->kronologi . '

        // *III. LOKASI*
        // -Kelurahan: ' . $dataLaporan->desa->name . '
        // -Kecamatan: ' . $dataLaporan->kecamatan->name . '
        // -Lokasi: ' . $dataLaporan->alamat . '

        // Untuk melihat lebih detailnya bisa akses link berikut : ' . url('/laporanwargas/' . $dataLaporan->id . '/detail') . '';


        //     $media = url('/storage/' . $dataLaporan->image1) . '';


        //     if ($row->hp) {
        //         $sendwa = WhatsApp::sendmedia($row->hp, $media, $pesanKeAdmin);
        //         $walog = [
        //             'name'      => $row->name,
        //             'number'    => $row->hp,
        //             'message'   => $pesanKeAdmin
        //         ];

        //         if ($sendwa) {
        //             $walog['status'] = true;
        //             Walog::create($walog);
        //         } else {
        //             $walog['status'] = false;
        //             Walog::create($walog);
        //         }
        //     }
        // }


        // kirim wa ke Kabid1
        // $kabid1 = User::where('level_id', 7)->get();
        // foreach ($kabid1 as $row) {
        //     $pesanKeAdmin = 'Kpd Yth. ' . $row->name . ' , Mohon ijin dengan hormat, melaporkan kejadian darurat yang disampaikan oleh masyarakat yaitu kejadian ' . $dataLaporan->kejadian . ' . sebagai berikut.

        // *I. Identittas Pelapor*
        // -Nama: ' . $dataLaporan->name . '
        // -Telepon: ' . $dataLaporan->telepon . '

        // *II. KRONOLOGI*
        // -Hari: ' . $dataLaporan->hari . '
        // -Tanggal: ' . $dataLaporan->tanggal . '
        // -Pukul: ' . $dataLaporan->pukul . '
        // -Kronologi Kejadian: ' . $dataLaporan->kronologi . '

        // *III. LOKASI*
        // -Kelurahan: ' . $dataLaporan->desa->name . '
        // -Kecamatan: ' . $dataLaporan->kecamatan->name . '
        // -Lokasi: ' . $dataLaporan->alamat . '

        // Untuk melihat lebih detailnya bisa akses link berikut : ' . url('/dashboard/laporandarurats/' . $dataLaporan->id . '/edit') . '';

        //     $media = url('/storage/' . $dataLaporan->image1) . '';

        //     if ($row->hp) {
        //         $sendwa = WhatsApp::sendmedia($row->hp, $media, $pesanKeAdmin);
        //         $walog = [
        //             'name'      => $row->name,
        //             'number'    => $row->hp,
        //             'message'   => $pesanKeAdmin
        //         ];

        //         if ($sendwa) {
        //             $walog['status'] = true;
        //             Walog::create($walog);
        //         } else {
        //             $walog['status'] = false;
        //             Walog::create($walog);
        //         }
        //     }
        // }


        // kirim wa ke Kabid2
        // $kabid2 = User::where('level_id', 8)->get();
        // foreach ($kabid2 as $row) {
        //     $pesanKeAdmin = 'Kpd Yth. ' . $row->name . ' , Mohon ijin dengan hormat, melaporkan kejadian darurat yang disampaikan oleh masyarakat yaitu kejadian ' . $dataLaporan->kejadian . ' . sebagai berikut.

        // *I. Identittas Pelapor*
        // -Nama: ' . $dataLaporan->name . '
        // -Telepon: ' . $dataLaporan->telepon . '

        // *II. KRONOLOGI*
        // -Hari: ' . $dataLaporan->hari . '
        // -Tanggal: ' . $dataLaporan->tanggal . '
        // -Pukul: ' . $dataLaporan->pukul . '
        // -Kronologi Kejadian: ' . $dataLaporan->kronologi . '

        // *III. LOKASI*
        // -Kelurahan: ' . $dataLaporan->desa->name . '
        // -Kecamatan: ' . $dataLaporan->kecamatan->name . '
        // -Lokasi: ' . $dataLaporan->alamat . '

        // Untuk melihat lebih detailnya bisa akses link berikut : ' . url('/laporanwargas/' . $dataLaporan->id . '/detail') . '';

        //     $media = url('/storage/' . $dataLaporan->image1) . '';

        //     if ($row->hp) {
        //         $sendwa = WhatsApp::sendmedia($row->hp, $media, $pesanKeAdmin);
        //         $walog = [
        //             'name'      => $row->name,
        //             'number'    => $row->hp,
        //             'message'   => $pesanKeAdmin
        //         ];

        //         if ($sendwa) {
        //             $walog['status'] = true;
        //             Walog::create($walog);
        //         } else {
        //             $walog['status'] = false;
        //             Walog::create($walog);
        //         }
        //     }
        // }




        return back()->with('success', 'Terimakasih! Pesan berhasil terkirim');
    }
}