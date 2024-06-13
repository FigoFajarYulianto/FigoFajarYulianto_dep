<?php

namespace App\Http\Controllers\Fronts;

use App\Helpers\WhatsApp;
use App\Http\Controllers\Controller;
use App\Models\Categoryconsultation;
use App\Models\Consultation;
use App\Models\Statusconsultation;
use App\Models\Walog;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;

class ConsultationRepliesController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.createkonsultasi', [
            'title_bar' => 'Konsultasi Baru',
            'category'    => Categoryconsultation::orderBy('nama', 'ASC')->get(),
            'status'    => Statusconsultation::orderBy('nama', 'ASC')->get(),
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
            'nomor'  => ['required'],
            'nama'      => ['required'],
            'whatsapp'      => ['required', 'min:10', 'max:13'],
            'alamat'      => ['required'],
            'categoryconsultation_id'      => ['required'],
            'statusconsultation_id'      => [''],
            'judul'      => ['required'],
            'pesan'      => ['required'],
            'lampiran'      => [''],
        ]);

        Consultation::create($data);

        return redirect('/dashboard/konsultasi')->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Consultation  $consultation
     * @return \Illuminate\Http\Response
     */
    public function show(Consultation $consultation)
    {
        return response()->json($consultation);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Consultation  $consultation
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $consultations = Consultation::with(['Categoryconsultation', 'Consultationreplies', 'statusconsultation'])->firstWhere('id', $id);
        return view('fronts.consultationreplies', [
            'title_bar' => 'Konsultasi',
            'consultations'    => $consultations
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Consultation  $consultation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $getconsultation = Consultation::where('id', $id)->first();

        $data = $request->validate([
            'nomor'  => ['required'],
            'nama'      => ['required'],
            'whatsapp'      => ['required', 'min:10', 'max:13'],
            'alamat'      => ['required'],
            'categoryconsultation_id'      => ['required'],
            'statusconsultation_id'      => [''],
            'judul'      => ['required'],
            'pesan'      => ['required'],
            'lampiran'      => [''],
        ]);

        Consultation::where('id', $getconsultation->id)->update($data);


        // kirim wa ke Pengguna
        $pesanKeUser = 'Konsultasi yang anda sampaikan telah diterima yaitu sebagai berikut :

*I. Nomor Konsultasi*
' . $getconsultation->nomor . '

*II. Identittas Konsultasi*
-Nama: ' . $getconsultation->nama . '
-Whatsapp: ' . $getconsultation->whatsapp . '

*III. Konsultasi*
-Judul: ' . $getconsultation->judul . '
-Pesan: ' . $getconsultation->pesan . '
-Lampiran: ' . $getconsultation->lampiran . '

*IV. Status*
' . $getconsultation->statusconsultation->nama . '';


        if ($getconsultation->whatsapp) {
            $sendwa = WhatsApp::sendmessage($getconsultation->whatsapp, $pesanKeUser);
            $walog = [
                'name'      => $getconsultation->nama,
                'number'    => $getconsultation->whatsapp,
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


        return redirect('/dashboard/konsultasi')->with('success', 'Data Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Consultation  $consultation
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $getconsultation = Consultation::where('id', $id)->first();

        Consultation::destroy($getconsultation->id);
        return redirect('/dashboard/konsultasi')->with('success', 'Data Berhasil Dihapus');
    }
}
