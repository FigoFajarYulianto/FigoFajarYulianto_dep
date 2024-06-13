<?php

namespace App\Http\Controllers\Backs;

use App\Helpers\WhatsApp;
use App\Http\Controllers\Controller;
use App\Models\Categoryconsultation;
use App\Models\Consultation;
use App\Models\Consultationreply;
use App\Models\Statusconsultation;
use App\Models\Walog;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;

class KonsultasiController extends Controller
{
    public function index(Request $request)
    {

        if ($request->has('search')) {
            $consultation    = Consultation::where('nama', 'LIKE', '%' . $request->search . '%')->Paginate(10);
        } else {
            $consultation    = Consultation::orderBy('nama', 'ASC')->Paginate(10);
        }

        $title_bar = 'Konsultasi';



        return view('dashboard.konsultasi', compact('consultation', 'title_bar'));

        // return view('dashboard.menus', [
        //     'title_bar' => 'Manajemen Menu',
        //     'menus'     => Menu::orderBy('sort', 'ASC')->get(),
        //     'mainMenus' => Menu::where('child', NULL)->get()
        // ]);
    }

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
    public function edit($id)
    {
        // $getconsultation = Consultation::where('id', $id)->first();
        $getconsultation = Consultation::with(['Categoryconsultation', 'Consultationreplies', 'statusconsultation'])->firstWhere('id', $id);
        return view('dashboard.editkonsultasi', [
            'title_bar' => 'Edit Konsultasi',
            'category'    => Categoryconsultation::orderBy('nama', 'ASC')->get(),
            'status'    => Statusconsultation::orderBy('nama', 'ASC')->get(),
            'consultation'    => $getconsultation
        ]);
    }


    public function reply(Request $request, Consultation $consultations)
    {
        $reply['consultation_id'] = $consultations->id;
        $reply['jawaban'] = $request->jawaban;
        $reply['user_id'] = auth()->user()->id ?? NULL;
        Consultationreply::create($reply);
        return back()->with('msg', '<div class="alert alert-success small mb-4" role="alert">Berhasil dikirim!</div>');
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

        $reply['consultation_id'] = $getconsultation->id;
        $reply['jawaban'] = $request->jawaban;
        $reply['user_id'] = auth()->user()->id ?? NULL;
        Consultationreply::create($reply);


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
' . $getconsultation->statusconsultation->nama . '

Untuk melanjutkan konsultasi silahkan klik link berikut ini :

' . url('/consultation/replies/' . $getconsultation->id) . '

Sekian Terimakasih';


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

    public function destroy_reply($id)
    {
        Consultationreply::destroy($id);
        return back()->with('success', 'Pesan Berhasil Dihapus');
    }
}
