<?php

namespace App\Http\Controllers\BackEnd;

use App\Models\Bank;
use App\Models\Dana;
use App\Models\Level;
use App\Models\Danafund;
use Illuminate\Support\Str;
use App\Models\Danafunditem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Danacategory;

class DanafundController extends Controller
{
    public function index()
    {
        $bagian = Level::where('id', auth()->user()->level_id)->first();
        $roles = explode(',', $bagian['access']);

        $danafunds = Danafund::with([
            'dana'
        ])
            ->filter(request(['name', 'dana', 'danacategory']))
            ->orderBy('created_at', 'DESC')
            ->paginate(100);

        return view('dashboard.danafunds', [
            'title_bar'     => 'Data Dana',
            'danafunds'     => $danafunds,
            'danas'         => Dana::all(),
            'danacategory'  => Danacategory::all(),
            'roles'         => $roles
        ]);
    }

    public function show(Dana $dana)
    {
        return response()->json($dana);
    }

    public function pemberi_dana(Dana $dana)
    {
        return view('dashboard.danafunddetail', [
            'title_bar'     => 'Pemberi Dana',
            'dana'          => $dana,
            'danafund'      => Danafund::firstWhere('dana_id', $dana->id),
            'danafunditems' => Danafunditem::where('dana_id', $dana->id)
                ->where('transaction_status', 'Berhasil')
                ->where('transaction_type', 'Transfer In')
                ->latest()
                ->paginate(100),
        ]);
    }

    public function show_withdrawal(Dana $dana)
    {
        return view('dashboard.danafundwithdrawal', [
            'title_bar'     => 'Riwayat Penarikan',
            'danafunditems' => Danafunditem::with('dana')->where('dana_id', $dana->id)
                ->latest()
                ->paginate(100),
            'danafund'      => Danafund::firstWhere('dana_id', $dana->id),
            'dana'          => $dana,
        ]);
    }

    public function create_withdrawal(Dana $dana)
    {
        return view('dashboard.danafundwithdrawalcreate', [
            'title_bar'         => 'Penarikan',
            'dana'              => $dana,
            'danafund'          => Danafund::with('danacategory')->firstWhere('dana_id', $dana->id),
            'banks'             => Bank::where('user_id', auth()->user()->id)->first(),
        ]);
    }

    public function store_withdrawal(Request $request, Dana $dana)
    {
        $data = $request->validate([
            'user_id'           => ['required'],
            'penerima_dana'     => ['required'],
            'transaction_type'  => ['required'],
            'gross_amount'      => ['required'],
            'bank_id'           => ['required'],
            'description'       => ['required'],
            'danacategory_id'   => ['required'],
        ]);

        $gross_amount = $request->gross_amount ? Str::replace(['.', ','], ['', '.'], $request->gross_amount) : 0;

        // Dana Fund Item
        $data['dana_id'] = $dana->id;
        $data['gross_amount'] = $gross_amount;
        $data['order_id'] = time();
        $data['transaction_status'] = 'Menunggu';
        $data['transaction_time'] = date('Y-m-d H:i:s');

        $tanggal = date('Y-m-d');
        $code = 'WD';
        $data['no_transaksi'] = Danafunditem::generateInv($code, $tanggal);

        if ($gross_amount > $dana->danafund->sisa_fund) {
            return back()->with('msg', '<div class="alert small alert-danger alert-dismissible fade show" role="alert">Saldo anda tidak cukup untuk melakukan penarikan. Saldo anda : <b>' . $dana->danafund->sisa_fund . '</b><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
        }

        Danafunditem::create($data);

        return back()->with('msg', '<div class="alert small alert-success alert-dismissible fade show" role="alert">Permintaan telah dikirim.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    }

    public function edit_withdrawal(Danafunditem $danafunditem)
    {
        return view('dashboard.danafundwithdrawaledit', [
            'title_bar'         => 'Penarikan',
            'danafunditem'      => $danafunditem,
            'danafund'          => Danafund::firstWhere('dana_id', $danafunditem->dana_id),
        ]);
    }

    public function update_withdrawal(Request $request, Danafunditem $danafunditem)
    {
        $data = $request->validate([
            'dana_id'           => ['required'],
            'user_id'           => ['required'],
            'transaction_type'  => ['required'],
            'gross_amount'      => ['required'],
            'bank_id'           => ['required'],
            'description'       => ['required'],
        ]);

        $gross_amount = $request->gross_amount ? Str::replace(['.', ','], ['', '.'], $request->gross_amount) : 0;

        // Dana Fund Item
        $data['description'] = $request->description;
        $data['gross_amount'] = $gross_amount;
        $data['order_id'] = time();
        $data['transaction_status'] = 'Menunggu';
        $data['transaction_time'] = date('Y-m-d H:i:s');

        if ($gross_amount > $danafunditem->dana->danafund->sisa_fund) {
            return back()->with('msg', '<div class="alert small alert-danger alert-dismissible fade show" role="alert">Saldo anda tidak cukup untuk melakukan penarikan. Saldo anda : <b>' . $danafunditem->dana->danafund->sisa_fund . '</b><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
        }

        Danafunditem::where('id', $danafunditem->id)->update($data);

        return back()->with('msg', '<div class="alert small alert-success alert-dismissible fade show" role="alert">Permintaan telah dikirim.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    }

    public function destroy_withdrawal(Danafunditem $danafunditem)
    {
        Danafunditem::destroy($danafunditem->id);
        return back()->with('msg', '<div class="alert small alert-success alert-dismissible fade show" role="alert">Data berhasil dihapus.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    }

    public function show_verifikasipenarikan()
    {
        return view('dashboard.danawithdrawals', [
            'title_bar'     => 'Data Penarikan Dana',
            'danafunditems' => Danafunditem::with('dana')->where('transaction_type', 'Transfer Out')->orderBy('created_at', 'DESC')->latest()->paginate(100),
        ]);
    }

    public function update_verifikasipenarikan(Request $request, Danafunditem $danafunditem)
    {
        $request->validate([
            'transaction_status' => ['required'],
        ]);

        $data['transaction_status'] = $request->transaction_status;

        if ($danafunditem->transaction_status == 'Berhasil') {
            $danafund = Danafund::where('dana_id', $danafunditem->dana_id)->first();
            $gross_amount['sisa_fund'] = $danafund->sisa_fund + $danafunditem->gross_amount;
            $gross_amount['penarikan_fund'] = $danafund->penarikan_fund - $danafunditem->gross_amount;
            Danafund::where('dana_id', $danafunditem->dana_id)->update($gross_amount);
        } else {
            if ($request->transaction_status == 'Berhasil') {
                $danafund = Danafund::where('dana_id', $danafunditem->dana_id)->first();
                $gross_amount['sisa_fund'] = $danafund->sisa_fund - $danafunditem->gross_amount;
                $gross_amount['penarikan_fund'] = $danafund->penarikan_fund + $danafunditem->gross_amount;
                Danafund::where('dana_id', $danafunditem->dana_id)->update($gross_amount);
            }
        }
        Danafunditem::where('id', $request->id)->update($data);

        return back()->with('msg', '<div class="alert alert-success small" role="alert">Berhasil disimpan!</div>');
    }

    public function danafunditemwithdrawals(Danafunditem $danafunditem)
    {
        return response()->json($danafunditem::with('user', 'dana')->firstWhere('id', $danafunditem->id));
    }
}
