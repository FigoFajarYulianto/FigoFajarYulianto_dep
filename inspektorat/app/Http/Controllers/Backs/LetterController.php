<?php

namespace App\Http\Controllers\Backs;

use App\Models\User;
use App\Models\Level;
use App\Models\Walog;
use App\Models\Letter;
use App\Helpers\WhatsApp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LetterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bagian = Level::where('id', auth()->user()->level_id)->first();
        $roles = explode(',', $bagian['access']);

        return view('dashboard.letters', [
            'title_bar' => 'Front Desk',
            'letters'   => Letter::latest()->paginate(100),
            'roles'     => $roles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.createletter', [
            'title_bar' => 'Entri Front Desk',
            'irbans'     => User::where('level_id', 5)->get()
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
            'tgl_surat'     => 'required',
            'perihal'       => 'required'
        ]);

        $data['nomor']  = Letter::generateNomor($request->tgl_surat);
        $data['tgl_surat']  = $request->tgl_surat ? date('Y-m-d H:i:s', strtotime($request->tgl_surat . ' ' . date('H:i:s'))) : NULL;
        $data['nomor_surat']  = $request->nomor_surat;
        $data['pengirim_opd']  = $request->pengirim_opd;
        $data['pengirim_nonopd']  = $request->pengirim_nonopd;
        $data['tgl_diterima']  = $request->tgl_diterima ? date('Y-m-d H:i:s', strtotime($request->tgl_diterima . ' ' . date('H:i:s'))) : NULL;
        $data['tgl_disposisi']  = $request->tgl_disposisi ? date('Y-m-d H:i:s', strtotime($request->tgl_disposisi . ' ' . date('H:i:s'))) : NULL;
        $data['disposisi']  = $request->disposisi;
        $data['irban_penerima']  = $request->irban_penerima;
        $data['nama_penerima']  = $request->nama_penerima;
        $data['keterangan']  = $request->keterangan;
        $data['user_id']  = auth()->user()->id;
        $query = Letter::create($data);

        if ($query && $request->disposisi && $request->irban_penerima) {
            // kirim wa
            $frontdesk = Letter::with('irban')->firstWhere('id', $query->id);

            $pesanWa = 'Hai *' . $frontdesk->irban->name . '* Surat dengan Nomor Surat *' . $request->nomor_surat . '* telah didisposisikan ke bagian anda, segera cek di Front Desk. 
Terimakasih !';

            if ($frontdesk->irban->hp) {
                $sendwa = WhatsApp::sendmessage($frontdesk->irban->hp, $pesanWa);
                $walog = [
                    'name'      => $frontdesk->irban->name,
                    'number'    => $frontdesk->irban->hp,
                    'message'   => $pesanWa
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

        return back()->with('success', 'Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Letter  $letter
     * @return \Illuminate\Http\Response
     */
    public function show(Letter $letter)
    {
        return response()->json($letter->load('irban'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Letter  $letter
     * @return \Illuminate\Http\Response
     */
    public function edit(Letter $letter)
    {
        return view('dashboard.editletter', [
            'title_bar' => 'Perbarui Front Desk',
            'irbans'    => User::where('level_id', 5)->get(),
            'letter'    => $letter
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Letter  $letter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Letter $letter)
    {
        $data = $request->validate([
            'tgl_surat'     => 'required',
            'perihal'       => 'required'
        ]);

        $data['tgl_surat']  = $request->tgl_surat ? date('Y-m-d H:i:s', strtotime($request->tgl_surat . ' ' . date('H:i:s'))) : NULL;
        $data['nomor_surat']  = $request->nomor_surat;
        $data['pengirim_opd']  = $request->pengirim_opd;
        $data['pengirim_nonopd']  = $request->pengirim_nonopd;
        $data['tgl_diterima']  = $request->tgl_diterima ? date('Y-m-d H:i:s', strtotime($request->tgl_diterima . ' ' . date('H:i:s'))) : NULL;
        $data['tgl_disposisi']  = $request->tgl_disposisi ? date('Y-m-d H:i:s', strtotime($request->tgl_disposisi . ' ' . date('H:i:s'))) : NULL;
        $data['disposisi']  = $request->disposisi;
        $data['irban_penerima']  = $request->irban_penerima;
        $data['nama_penerima']  = $request->nama_penerima;
        $data['keterangan']  = $request->keterangan;
        $data['user_id']  = auth()->user()->id;

        $query = Letter::where('id', $letter->id)->update($data);

        if ($query && $request->disposisi && $request->irban_penerima) {
            // kirim wa
            $frontdesk = Letter::with('irban')->firstWhere('id', $letter->id);

            $pesanWa = 'Hai *' . $frontdesk->irban->name . '* Surat dengan Nomor Surat *' . $letter->nomor_surat . '*  telah didisposisikan ke bagian anda, segera cek di Front Desk. 
Terimakasih !';

            if ($frontdesk->irban->hp) {
                $sendwa = WhatsApp::sendmessage($frontdesk->irban->hp, $pesanWa);
                $walog = [
                    'name'      => $frontdesk->irban->name,
                    'number'    => $frontdesk->irban->hp,
                    'message'   => $pesanWa
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

        return back()->with('success', 'Data berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Letter  $letter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Letter $letter)
    {
        Letter::destroy($letter->id);
        return back()->with('success', 'Data berhasil dihapus');
    }
}
