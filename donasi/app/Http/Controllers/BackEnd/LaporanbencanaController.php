<?php

namespace App\Http\Controllers\BackEnd;

use App\Models\Bank;
use App\Models\Dana;
use App\Models\User;
use App\Models\Level;
use App\Models\Walog;
use App\Models\Danafund;
use App\Models\District;
use App\Models\Province;
use App\Helpers\WhatsApp;
use App\Models\Subdistrict;
use Illuminate\Support\Str;
use App\Models\Danacategory;
use App\Models\Danafunditem;
use Illuminate\Http\Request;
use App\Models\Laporanbencana;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class LaporanbencanaController extends Controller
{
    public function index()
    {
        $bagian = Level::where('id', auth()->user()->level_id)->first();
        $roles = explode(',', $bagian['access']);

        $laporanbencanas = Laporanbencana::with([
            'province', 'district', 'subdistrict'
        ])
            ->filter(request(['name', 'province', 'district', 'subdistrict', 'status', 'startdate', 'enddate']))
            ->latest()
            ->paginate(50);

        return view('dashboard.laporanbencanas', [
            'title_bar'         => 'Data Laporan Bencana',
            'laporanbencanas'   => $laporanbencanas,
            'roles'             => $roles,
            'provinces'         => Province::orderBy('name', 'ASC')->get(),
            'districts'         => District::orderBy('name', 'ASC')->get(),
            'subdistricts'      => Subdistrict::orderBy('name', 'ASC')->get(),
        ]);
    }

    public function show(Laporanbencana $laporanbencana)
    {
        return response()->json($laporanbencana);
    }

    public function edit(Laporanbencana $laporanbencana)
    {
        return view('dashboard.laporanbencanaedit', [
            'title_bar'      => 'Laporan Bencana',
            'laporanbencana' => $laporanbencana,
            'provinces'      => Province::orderBy('name', 'ASC')->get(),
            'districts'      => District::orderBy('name', 'ASC')->get(),
            'subdistricts'   => Subdistrict::orderBy('name', 'ASC')->get(),
        ]);
    }

    public function update(Request $request, Laporanbencana $laporanbencana)
    {
        $data = $request->validate([
            'name'              => ['required'],
            'telepon'           => ['required'],
            'kejadian'          => ['required'],
            'hari'              => ['required'],
            'bulan'             => ['required'],
            'tanggal'           => [''],
            'pukul'             => [''],
            'alamat'            => ['required'],
            'province_id'       => ['required'],
            'district_id'       => ['required'],
            'subdistrict_id'    => ['required'],
            'la_latitude'       => [''],
            'la_longitude'      => [''],
            'image1'            => ['image', 'file', 'max:2048'],
            'image2'            => ['image', 'file', 'max:2048'],
            'kronologi'         => ['required'],
            'status'            => ['required'],
        ]);

        if ($request->hasFile('image1')) {
            if ($laporanbencana->image1) {
                Storage::delete($laporanbencana->image1);
            }
            $data['image1'] = $request->image1->store('uploads');
        }

        if ($request->hasFile('image2')) {
            if ($laporanbencana->image2) {
                Storage::delete($laporanbencana->image2);
            }
            $data['image2'] = $request->image2->store('uploads');
        }

        // kirim wa ke Admin
        $admin = User::where('level_id', 1)->get();
        foreach ($admin as $row) {
            $pesanKeAdmin = 'Kpd Yth. ' . $row->name . ' , Laporan bencana dari ' . $request->name . '

*I. PADA*
-Hari: ' . $request->hari  . '
-Tanggal: ' . $request->tanggal . '
-Bulan: ' . $request->bulan . '
-Jam: ' . $request->pukul . '
                
*II. KEJADIAN*
' . $request->kejadian . '
' . $request->alamat . '
                
Telah ' . $request->status . ' Sekian Terimakasih. ';


            if ($row->no_phone) {
                $sendwa = WhatsApp::sendmessage($row->no_phone, $pesanKeAdmin);
                $walog = [
                    'name'      => $row->name,
                    'number'    => $row->no_phone,
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


        // kirim wa ke User
        $pesanKeUser = 'Kpd Yth. ' . $laporanbencana->name . ' , jawaban Admin pada status laporan anda.

*I. PADA*
    -Hari: ' . $request->hari  . '
    -Tanggal: ' . $request->tanggal . '
    -Bulan: ' . $request->bulan . '
    -Jam: ' . $request->pukul . '
        
*II. KEJADIAN*
' . $request->kejadian . '
' . $request->alamat . '

Telah ' . $request->status . ' Sekian Terimakasih. ';

        if ($laporanbencana->telepon) {
            $sendwa = WhatsApp::sendmessage($laporanbencana->telepon, $pesanKeUser);
            $walog = [
                'name'      => $laporanbencana->name,
                'number'    => $laporanbencana->telepon,
                'message'   => $pesanKeUser
            ];
            if ($sendwa) {
                $walog['status'] = true;
                Walog::create($walog);
            } else {
                $walog['status'] = false;
                Walog::create($walog);
            }
        }

        Laporanbencana::where('id', $laporanbencana->id)->update($data);

        return back()->with('msg', '<div class="alert small alert-success alert-dismissible fade show" role="alert">Data Berhasil Diperbarui.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    }

    public function detail(Laporanbencana $laporanbencana)
    {
        return view('dashboard.laporanbencanashow', [

            'provinces'         => Province::orderBy('name', 'ASC')->get(),
            'laporanbencana'    => $laporanbencana
        ]);
    }

    public function destroy(Laporanbencana $laporanbencana)
    {
        Laporanbencana::destroy($laporanbencana->id);
        return back()->with('success', 'Data Berhasil Dihapus');
    }

    // public function download(Laporanbencana $laporanbencana)
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
