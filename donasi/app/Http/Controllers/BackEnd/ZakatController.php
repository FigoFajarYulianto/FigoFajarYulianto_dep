<?php

namespace App\Http\Controllers\BackEnd;

use App\Models\Bank;
use App\Models\Level;
use App\Models\Zakat;
use App\Models\Zakatfund;
use App\Models\Withdrawal;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Zakattransactionitem;
use Cviebrock\EloquentSluggable\Services\SlugService;

class ZakatController extends Controller
{
    public function index()
    {
        $bagian = Level::where('id', auth()->user()->level_id)->first();
        $roles = explode(',', $bagian['access']);

        return view('dashboard.zakats', [
            'title_bar' => 'Data Zakat',
            'zakats'    => Zakat::with('zakatfund', 'zakattransactionitems')->latest()->paginate(10),
            'roles'     => $roles
        ]);
    }

    public function show(Zakat $zakat)
    {
        return response()->json($zakat);
    }

    public function update(Request $request, Zakat $zakat)
    {
        $data = $request->validate([
            'title'         => ['required'],
            'description'   => ['required']
        ]);

        $data['slug'] = $request->title !== $zakat->title ? SlugService::createSlug(Zakat::class, 'slug', $request->title) : $zakat->slug;

        Zakat::where('id', $zakat->id)->update($data);
        return back()->with('msg', '<div class="alert alert-success small" role="alert">Berhasil disimpan!</div>');
    }

    public function show_muzakki(Zakat $zakat)
    {
        return view('dashboard.zakatmuzakki', [
            'title_bar'             => 'Muzakki',
            'zakat'                 => $zakat,
            'zakattransactionitems' => Zakattransactionitem::where('zakat_id', $zakat->id)
                ->where('transaction_status', 'Berhasil')
                ->where('transaction_type', 'Zakat')
                ->latest()
                ->paginate(100),
        ]);
    }

    public function show_withdrawal(Zakat $zakat)
    {
        return view('dashboard.zakatwithdrawal', [
            'title_bar'             => 'Riwayat Penarikan',
            'zakattransactionitems' => Zakattransactionitem::where('zakat_id', $zakat->id)
                ->latest()
                ->paginate(100),
            'zakatfund'             => Zakatfund::where('zakat_id', $zakat->id)->first(),
            'zakat'                 => $zakat,
        ]);
    }

    public function create_withdrawal(Zakat $zakat)
    {
        return view('dashboard.zakatwithdrawalcreate', [
            'title_bar'         => 'Penarikan',
            'zakat'             => $zakat,
            'banks'             => Bank::where('user_id', auth()->user()->id)->first(),
        ]);
    }

    public function store_withdrawal(Request $request, Zakat $zakat)
    {
        $data = $request->validate([
            'user_id'           => ['required'],
            'penerima_zakat'    => ['required'],
            'transaction_type'  => ['required'],
            'gross_amount'      => ['required'],
            'bank_id'           => ['required'],
            'description'       => ['required'],
        ]);

        $gross_amount = $request->gross_amount ? Str::replace(['.', ','], ['', '.'], $request->gross_amount) : 0;

        // Zakat Transaction Item
        $data['zakat_id'] = $zakat->id;
        $data['gross_amount'] = $gross_amount;
        $data['order_id'] = time();
        $data['transaction_status'] = 'Menunggu';
        $data['transaction_time'] = date('Y-m-d H:i:s');

        $tanggal = date('Y-m-d');
        $code = 'PNZ';
        $data['no_transaksi'] = Zakattransactionitem::generateInv($code, $tanggal);

        if ($gross_amount > $zakat->zakatfund->sisa_fund) {
            return back()->with('msg', '<div class="alert small alert-danger alert-dismissible fade show" role="alert">Saldo anda tidak cukup untuk melakukan penarikan. Saldo anda : <b>' . $zakat->zakatfund->sisa_fund . '</b><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
        }

        Zakattransactionitem::create($data);

        return back()->with('msg', '<div class="alert small alert-success alert-dismissible fade show" role="alert">Permintaan telah dikirim.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    }

    public function edit_withdrawal(Zakattransactionitem $zakattransactionitem)
    {
        return view('dashboard.zakatwithdrawaledit', [
            'title_bar'             => 'Penarikan',
            'zakattransactionitems' => Zakattransactionitem::with('user')
                ->where('zakat_id', $zakattransactionitem->id)
                ->where('transaction_type', 'Penarikan')
                ->where('transaction_status', 'Berhasil')
                ->latest()
                ->paginate(100),
            'zakatfund'             => Zakatfund::where('zakat_id', $zakattransactionitem->id)->first(),
            'zakattransactionitem'  => $zakattransactionitem,
            'zakat'                 => Zakat::where('id', $zakattransactionitem->zakat_id)->first(),
            'banks'                 => Bank::where('user_id', $zakattransactionitem->user_id)->first(),
        ]);
    }

    public function update_withdrawal(Request $request, Zakattransactionitem $zakattransactionitem)
    {
        $data = $request->validate([
            'user_id'           => ['required'],
            'transaction_type'  => ['required'],
            'gross_amount'      => ['required'],
            'bank_id'           => ['required'],
            'description'       => ['required'],
        ]);

        $gross_amount = $request->gross_amount ? Str::replace(['.', ','], ['', '.'], $request->gross_amount) : 0;

        // Campaign Fund Item
        $data['description'] = $request->description;
        $data['gross_amount'] = $gross_amount;
        $data['zakat_id'] = $zakattransactionitem->campaign_id;
        $data['order_id'] = time();
        $data['transaction_status'] = 'Menunggu';
        $data['transaction_time'] = date('Y-m-d H:i:s');

        if ($gross_amount > $zakattransactionitem->zakat->zakatfund->sisa_fund) {
            return back()->with('msg', '<div class="alert small alert-danger alert-dismissible fade show" role="alert">Saldo anda tidak cukup untuk melakukan penarikan. Saldo anda : <b>' . $zakattransactionitem->zakat->zakatfund->sisa_fund . '</b><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
        }

        Zakattransactionitem::where('id', $zakattransactionitem->id)->update($data);

        return back()->with('msg', '<div class="alert small alert-success alert-dismissible fade show" role="alert">Permintaan telah dikirim.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    }

    public function destroy_withdrawal(Zakattransactionitem $zakattransactionitem)
    {
        Zakattransactionitem::destroy($zakattransactionitem->id);
        return back()->with('msg', '<div class="alert small alert-success alert-dismissible fade show" role="alert">Data berhasil dihapus.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    }

    public function show_verifikasipenarikan()
    {
        return view('dashboard.zakatwithdrawals', [
            'title_bar'         => 'Data Penarikan Zakat',
            'zakatwithdrawals'  => Zakattransactionitem::where('transaction_type', 'Penarikan')->orderBy('created_at', 'DESC')->latest()->paginate(100),
        ]);
    }

    public function update_verifikasipenarikan(Request $request, Zakattransactionitem $zakattransactionitem)
    {
        $request->validate([
            'transaction_status' => ['required'],
        ]);

        $data['transaction_status'] = $request->transaction_status;

        if ($zakattransactionitem->transaction_status == 'Berhasil') {
            $zakatfund = Zakatfund::where('zakat_id', $zakattransactionitem->zakat_id)->first();
            $gross_amount['sisa_fund'] = $zakatfund->sisa_fund + $zakattransactionitem->gross_amount;
            $gross_amount['penarikan_fund'] = $zakatfund->penarikan_fund - $zakattransactionitem->gross_amount;
            Zakatfund::where('zakat_id', $zakattransactionitem->zakat_id)->update($gross_amount);
        } else {
            if ($request->transaction_status == 'Berhasil') {
                $zakatfund = Zakatfund::where('zakat_id', $zakattransactionitem->zakat_id)->first();
                $gross_amount['sisa_fund'] = $zakatfund->sisa_fund - $zakattransactionitem->gross_amount;
                $gross_amount['penarikan_fund'] = $zakatfund->penarikan_fund + $zakattransactionitem->gross_amount;
                Zakatfund::where('zakat_id', $zakattransactionitem->zakat_id)->update($gross_amount);
            }
        }
        Zakattransactionitem::where('id', $request->id)->update($data);

        return back()->with('msg', '<div class="alert alert-success small" role="alert">Berhasil disimpan!</div>');
    }

    public function zakaattransactionwithdrawals(Zakattransactionitem $zakattransactionitem)
    {
        return response()->json($zakattransactionitem::with('user', 'zakat')->firstWhere('id', $zakattransactionitem->id));
    }
}
