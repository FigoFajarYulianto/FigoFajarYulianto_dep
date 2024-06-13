<?php

namespace App\Http\Controllers\FrontEnd;

use App\Rules\ReCaptcha;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Consultation;
use App\Models\Consultationreplies;

class ConsultationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nik'                   => ['required'],
            'name'                  => ['required'],
            'servicecategory_id'    => ['required'],
            'jk'                    => ['required'],
            'email'                 => [''],
            'phone'                 => ['required'],
            'alamat'                => ['required'],
            'konsultasi'            => ['required'],
            'g-recaptcha-response'  => ['required', new ReCaptcha]
        ]);

        $data = [
            'nik'                   => $request->nik,
            'name'                  => $request->name,
            'servicecategory_id'    => $request->servicecategory_id,
            'jk'                    => $request->jk,
            'email'                 => $request->email,
            'phone'                 => $request->phone,
            'alamat'                => $request->alamat,
            'konsultasi'            => $request->konsultasi,
            'status_id'             => 1,
        ];

        $tanggal = date('Y-m-d');
        $code = 'KN';
        $data['id_konsultasi'] = Consultation::generateInv($code, $tanggal);

        Consultation::create($data);

        return back()->with('msg', '<div class="alert small alert-success alert-dismissible fade show" role="alert">Konsultasi anda berhasil terkirim! Tunggu balasan by WA.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    }

    public function show($id)
    {
        $cosultations = Consultation::with(['servicecategory', 'status', 'consultationreplies'])->firstWhere('id', $id);
        return view('frontend.detailcosultation', [
            'title_bar'     => $cosultations->servicecategory->name . ' No. ' . $cosultations->id_konsultasi,
            'consultation'  => $cosultations
        ]);
    }

    public function reply(Request $request, Consultation $consultation)
    {
        $reply['consultation_id'] = $consultation->id;
        $reply['jawaban'] = $request->jawaban;
        $reply['user_id'] = auth()->user()->id ?? NULL;
        Consultationreplies::create($reply);
        return back()->with('msg', '<div class="alert alert-success small mb-4" role="alert">Berhasil dikirim!</div>');
    }

    public function destroy_reply($id)
    {
        $reply = Consultationreplies::firstWhere('id', $id);
        if ($reply && $reply->user_id == NULL) {
            Consultationreplies::destroy($id);
            return back()->with('msg', '<div class="alert alert-success small mb-4" role="alert">Berhasil dihapus!</div>');
        } else {
            abort(404);
        }
    }
}
