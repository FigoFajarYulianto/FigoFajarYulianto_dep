<?php

namespace App\Http\Controllers\Fronts;

use App\Helpers\WhatsApp;
use App\Http\Controllers\Controller;
use App\Models\Categoryconsultation;
use App\Models\Consultation;
use App\Models\Consultationreply;
use App\Models\Statusconsultation;
use App\Models\Walog;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;
use App\Rules\ReCaptcha;
use App\Models\User;

class ConsultationRepliesController extends Controller
{

    public function show($id)
    {
        // $consultations = Consultation::with(['Categoryconsultation', 'Consultationreplies', 'statusconsultation'])->firstWhere('id', $id);
        $consultations = Consultation::with(['Categoryconsultation', 'Consultationreplies', 'statusconsultation'])->firstWhere('id', $id);
        return view('fronts.consultationreplies', [
            'consultations'  => $consultations
        ]);
    }

    public function reply(Request $request, Consultation $consultations)
    {
        $reply['consultation_id'] = $consultations->id;
        $reply['jawaban'] = $request->jawaban;
        $reply['user_id'] = auth()->user()->id ?? NULL;
        $request->validate([
            'g-recaptcha-response'  => ['required', new ReCaptcha]
        ]);

        $queryConsultationreply = Consultationreply::create($reply);
        $dataConsultationreply = Consultationreply::firstWhere('id', $queryConsultationreply->id);

        // kirim wa ke Admin
        $admin  = User::where('level_id', 1)->get();
        foreach ($admin as $row) {
            $pesanKeAdmin = 'Halo Admin pada hari ini tanggal dan jam ' . $dataConsultationreply->created_at->format('d/m/Y') . ' ' . $dataConsultationreply->created_at->format('h:i') . '  dengan customer atas nama ' . $dataConsultationreply->consultation->nama . ' . Telah menjawab konsultasi hukum, segera cek di dashboard ';

            if ($row->whatsapp) {
                $sendwa = WhatsApp::sendmessage($row->whatsapp, $pesanKeAdmin);
                $walog = [
                    'name'      => $row->name,
                    'number'    => $row->whatsapp,
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

        return back()->with('msg', '<div class="alert alert-success small mb-4" role="alert">Berhasil dikirim!</div>');
    }
}
