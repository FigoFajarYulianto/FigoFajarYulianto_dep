<?php

namespace App\Http\Controllers\BackEnd;

use App\Models\User;
use App\Models\Level;
use App\Models\Walog;
use App\Rules\ReCaptcha;
use App\Helpers\WhatsApp;
use App\Models\Consultation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Consultationreplies;
use App\Models\Status;

class ConsultationController extends Controller
{
    public function index()
    {
        // $coba = Consultation::firstWhere('id', 3);
        // $coba2 = $coba->created_at;
        // $coba1 = date_format($coba2, 'l');
        // $coba3 = $coba1 == 'Monday' ? 'Senin' : ($coba1 == 'Tuesday' ? 'Selasa' : ($coba1 == 'Wednesday' ? 'Rabu' : ($coba1 == 'Thursday' ? 'Kamis' : ($coba1 == 'Friday' ? 'Jumat' : ($coba1 == 'Saturday' ? 'Sabtu' : 'Sunday')))));
        // dd($coba3);
        $bagian = Level::where('id', auth()->user()->level_id)->first();
        $roles = explode(',', $bagian['access']);

        return view('dashboard.consultations', [
            'title_bar'         => 'Layanan Konsultasi',
            'consultations'     => Consultation::with('servicecategory', 'status', 'consultationreplies')->latest()->paginate(50),
            'roles'             => $roles
        ]);
    }

    public function edit(Consultation $consultation)
    {
        return view('dashboard.editconsultation', [
            'title_bar'     => 'Perbarui Konsultasi',
            'consultation'  => $consultation->load('consultationreplies'),
            'statuses'      => Status::all(),
        ]);
    }

    public function update(Request $request, Consultation $consultation)
    {
        // $data['jawaban'] = $request->jawaban;
        $data['status_id'] = $request->status_id == $consultation->status_id ? $consultation->status_id : $request->status_id;
        $hari = date_format($consultation->created_at, 'l');
        $hariname = $hari == 'Monday' ? 'Senin' : ($hari == 'Tuesday' ? 'Selasa' : ($hari == 'Wednesday' ? 'Rabu' : ($hari == 'Thursday' ? 'Kamis' : ($hari == 'Friday' ? 'Jumat' : ($hari == 'Saturday' ? 'Sabtu' : 'Sunday')))));

        if ($request->status == 2) {
            // kirim wa ke Admin
            $admin = User::where('level_id', 1)->get();
            foreach ($admin as $row) {
                $pesanKeAdmin = 'Kpd Yth. ' . $row->name . ' , jawaban anda pada konsultasi ' . $consultation->name . '

                *I. PADA*
                -Hari: ' . $hariname  . '
                -Tanggal: ' . date_format($consultation->created_at, 'd') . '
                -Bulan: ' . date_format($consultation->created_at, 'F') . '
                -Jam: ' . date_format($consultation->created_at, 'H:i:s') . '
                    
                *II. KONSULTASI*
                ' . $consultation->konsultasi . '
                    
                *III. JAWABAN*
                ' . $request->jawaban . '
                    
                Sekian Terimakasih.';

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


            // kirim wa ke User
            $pesanKeUser = 'Kpd Yth. ' . $consultation->name . ' , jawaban anda pada konsultasi ' . $consultation->name . '.

            *I. PADA*
            -Hari: ' .  $hariname . '
            -Tanggal: ' . date_format($consultation->created_at, 'd') . '
            -Bulan: ' . date_format($consultation->created_at, 'F') . '
            -Jam: ' . date_format($consultation->created_at, 'H:i:s') . '
            
            *II. KONSULTASI*
            ' . $consultation->konsultasi . '
            
            *III. JAWABAN*
            ' . $request->jawaban . '

            Silahkan klik link berikut untuk membalas:
            ' . url('/consultation/' . $consultation->id) . '

            Sekian Terimakasih. ';

            if ($consultation->phone) {
                $sendwa = WhatsApp::sendmessage($consultation->phone, $pesanKeUser);
                $walog = [
                    'name'      => $consultation->name,
                    'number'    => $consultation->hp,
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

        Consultation::where('id', $consultation->id)->update($data);

        $reply['consultation_id'] = $consultation->id;
        $reply['jawaban'] = $request->jawaban;
        $reply['user_id'] = auth()->user()->id;
        Consultationreplies::create($reply);

        return back()->with('msg', '<div class="alert alert-success small" role="alert">Berhasil disimpan!</div>');
    }

    public function destroy(Consultation $consultation)
    {
        Consultation::destroy($consultation->id);
        return back()->with('msg', '<div class="alert alert-success small" role="alert">Data Berhasil dihapus!</div>');
    }

    public function destroy_reply($id)
    {
        Consultationreplies::destroy($id);
        return back()->with('msg', '<div class="alert alert-success small" role="alert">Data Berhasil dihapus!</div>');
    }
}
