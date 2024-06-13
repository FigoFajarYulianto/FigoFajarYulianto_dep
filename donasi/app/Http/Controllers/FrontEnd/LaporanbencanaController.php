<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\Dana;
use App\Models\User;
use App\Models\Walog;
use App\Models\Zakat;
use App\Models\Setting;
use App\Models\District;
use App\Models\Province;
use App\Rules\ReCaptcha;
use App\Helpers\WhatsApp;
use App\Models\Subdistrict;
use Illuminate\Http\Request;
use App\Models\Laporanbencana;
use App\Http\Controllers\Controller;

class LaporanbencanaController extends Controller
{
    public function index()
    {
        return view('frontend.laporanbencana', [
            'provinces'    => Province::orderBy('name', 'ASC')->get(),
            'districts'    => District::orderBy('name', 'ASC')->get(),
            'subdistricts' => Subdistrict::orderBy('name', 'ASC')->get(),
            'title_bar'    => 'Laporan Bencana',

        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'              => ['required'],
            'telepon'           => ['required'],
            'kejadian'          => ['required'],
            'hari'              => ['required'],
            'tanggal'           => ['required'],
            'bulan'             => ['required'],
            'pukul'             => ['required'],
            'alamat'            => ['required'],
            'province_id'       => ['required'],
            'district_id'       => ['required'],
            'subdistrict_id'    => ['required'],
            'la_latitude'       => [''],
            'la_longitude'      => [''],
            'image1'            => ['image', 'file', 'max:2048'],
            'image2'            => ['image', 'file', 'max:2048'],
            'kronologi'         => ['required'],
        ]);

        $request->validate([
            'g-recaptcha-response'  => ['required', new ReCaptcha]
        ]);

        $data['image1'] = $request->hasFile('image1')  ? $request->image1->store('uploads') : NULL;

        $data['image2'] = $request->hasFile('image2')  ? $request->image2->store('uploads') : NULL;

        $data['status'] = 'Menunggu';

        // kirim wa ke Admin
        $admin = User::where('level_id', 1)->get();
        foreach ($admin as $row) {
            $pesanKeAdmin = 'Kpd Yth. ' . $row->name . ' , Terdapat laporan bencana dari ' . $request->name . '

*I. PADA*
-Hari: ' . $request->hari  . '
-Tanggal: ' . $request->tanggal . '
-Bulan: ' . $request->bulan . '
-Jam: ' . $request->pukul . '
                
*II. KEJADIAN*
' . $request->kejadian . '
' . $request->alamat . '
                
Sekian Terimakasih. ';


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

        Laporanbencana::create($data);

        return back()->with('msg', '<div class="alert small alert-success alert-dismissible fade show" role="alert"><center>Terimakasih! Pesan Berhasil Terkirim.</center><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    }
}
