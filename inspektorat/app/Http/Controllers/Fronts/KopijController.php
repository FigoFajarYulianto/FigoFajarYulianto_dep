<?php

namespace App\Http\Controllers\Fronts;

use App\Models\User;
use App\Models\Kopij;
use App\Models\Walog;
use App\Helpers\WhatsApp;
use App\Models\Kopijitem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KopijController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request('nomor')) {
            $kopij = Kopij::with('kopijitems', 'status')->where('nomor', request('nomor'))->first();
            return view('fronts.detailkopij', [
                'title_bar' => 'KONSULTASI NO. ' . $kopij->nomor,
                'kopij'     => $kopij
            ]);
        } else {
            return view('fronts.kopij', [
                'title_bar'    => 'KOPI-J',
            ]);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'                  => 'required',
            'nik'                   => 'required',
            'jenis_kelamin'         => 'required',
            'nomor_wa'              => 'required',
            'judul'                 => 'required',
            'deskripsi'             => 'required',
            'file_ktp'              => 'required|image|file|max:2048',
            'file_kk'               => 'image|file|max:2048',
            'file_lain1'            => 'image|file|max:2048',
            'file_lain2'            => 'image|file|max:2048',
            'g-recaptcha-response'  => 'required'
        ]);

        $data['nomor'] = Kopij::generateNomor(date('Y-m-d'));
        $data['nama'] = $request->nama;
        $data['nik'] = $request->nik;
        $data['jenis_kelamin'] = $request->jenis_kelamin;
        $data['nomor_wa'] = $request->nomor_wa;
        $data['judul'] = $request->judul;
        $data['deskripsi'] = $request->deskripsi;
        $data['file_ktp'] = $request->hasFile('file_ktp') ? $request->file_ktp->store('uploads') : NULL;
        $data['file_kk'] = $request->hasFile('file_kk') ? $request->file_kk->store('uploads') : NULL;
        $data['file_lain1'] = $request->hasFile('file_lain1') ? $request->file_lain1->store('uploads') : NULL;
        $data['file_lain2'] = $request->hasFile('file_lain2') ? $request->file_lain2->store('uploads') : NULL;
        $data['status_id'] = 0;

        $query = Kopij::create($data);
        if ($query) {

            $kopij = Kopij::with('kopijitems', 'status')->firstWhere('id', $query->id);
            $hari = date_format($kopij->created_at, 'l');
            $hariname = $hari == 'Monday' ? 'Senin' : ($hari == 'Tuesday' ? 'Selasa' : ($hari == 'Wednesday' ? 'Rabu' : ($hari == 'Thursday' ? 'Kamis' : ($hari == 'Friday' ? 'Jumat' : ($hari == 'Saturday' ? 'Sabtu' : 'Sunday')))));

            // kirim WA ke User
            $pesanKeUser = 'Yth. *' . $kopij->nama . '*, terimakasih telah menggunakan layanan *KOPI-J*
 
 *I. PADA:*
 - Nomor: ' . $kopij->nomor  . '
 - Hari: ' .  $hariname . '
 - Tanggal: ' . date_format($kopij->created_at, 'd') . '
 - Bulan: ' . date_format($kopij->created_at, 'F') . '
 - Jam: ' . date_format($kopij->created_at, 'H:i:s') . '
 
 *II. KONSULTASI:*
 ' . $kopij->judul . '
 
 Silahkan klik link berikut untuk melihat detail atau membalas:
 ' . url('/kopij?nomor=' . $kopij->nomor) . '
 
 Terimakasih. ';

            if ($kopij->nomor_wa) {
                $sendwa = WhatsApp::sendmessage($kopij->nomor_wa, $pesanKeUser);
                $walog = [
                    'name'      => $kopij->nama,
                    'number'    => $kopij->nomor_wa,
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

            return back()->with('success', 'Pesan berhasil terkirim');
        } else {
            return back()->with('info', 'Pesan gagal terkirim');
        }
    }

    public function reply(Request $request)
    {
        $data = $request->validate([
            'kopij_id'  => 'required',
            'pesan'     => 'required'
        ]);

        $query = Kopijitem::create($data);
        if ($query) {
            $kopij = Kopij::with('kopijitems', 'status')->firstWhere('id', $request->kopij_id);
            $hari = date_format($kopij->created_at, 'l');
            $hariname = $hari == 'Monday' ? 'Senin' : ($hari == 'Tuesday' ? 'Selasa' : ($hari == 'Wednesday' ? 'Rabu' : ($hari == 'Thursday' ? 'Kamis' : ($hari == 'Friday' ? 'Jumat' : ($hari == 'Saturday' ? 'Sabtu' : 'Sunday')))));

            // kirim wa ke Admin
            $admin = User::where('level_id', 1)->get();
            foreach ($admin as $row) {
                $pesanKeAdmin = 'Yth. *' . $row->name . '*, jawaban atas konsultasi *KOPI-J*
 
 *I. PADA:*
 - Nomor: ' . $kopij->nomor  . '
 - Hari: ' . $hariname  . '
 - Tanggal: ' . date_format($kopij->created_at, 'd') . '
 - Bulan: ' . date_format($kopij->created_at, 'F') . '
 - Jam: ' . date_format($kopij->created_at, 'H:i:s') . '
 
 *II. KONSULTASI:*
 ' . $kopij->judul . '
 
 *III. JAWABAN:*
 ' . $request->pesan . '
 
 Terimakasih.';

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

            return back()->with('success', 'Pesan berhasil terkirim');
        } else {
            return back()->with('info', 'Pesan gagal terkirim');
        }
    }

    public function trash($id)
    {
        $kopijitem = Kopijitem::firstWhere('id', $id);
        if ($kopijitem) {
            Kopijitem::destroy($kopijitem->id);
            return back()->with('success', 'Pesan berhasil dihapus');
        } else {
            return back()->with('info', 'Pesan gagal dihapus');
        }
    }
}
