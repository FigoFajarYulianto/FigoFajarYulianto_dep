<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Dana;
use App\Models\Zakat;

class CalculatorController extends Controller
{
    public function index()
    {
        return view('frontend.zakatcalculator', [
            'title_bar'             => 'Kalkulator Zakat',
            'zakatpenghasilan'      => Dana::firstWhere('slug', 'zakat-profesi-penghasilan'),
            'zakatmal'              => Dana::firstWhere('slug', 'zakat-maal'),
            'zakatperdagangan'      => Dana::firstWhere('slug', 'zakat-perdagangan'),
            'zakatsimpanan'         => Dana::firstWhere('slug', 'zakat-simpanan'),
        ]);
    }

    public function profesi(Request $request)
    {
        $setting = Setting::firstWhere('id', 1);

        $harga_emas     = $setting->harga_emas; // harga emas saat ini
        $nishab         = 85; // 85 gram emas
        $kadar          = 2.5 / 100; // kadar zakat 2.5%
        $wajib_zakat    = $harga_emas * $nishab / 12; // dibagi 12 bulan

        $penghasilan    = $request->pendapatan; // Penghasilan per bulan
        $bonus_thr      = $request->lainnya; // Bonus per bulan atau THR (jika ada)
        // $hutang         = 900000; // Hutang / cicilan per bulan (jika ada)
        $total          = $penghasilan + $bonus_thr;

        if ($total >= $wajib_zakat) {
            $zakat = $total * $kadar;
            return response()->json($zakat); // tampilkan nilai zakat
        } else {
            return response()->json('Belum Wajib Zakat'); // tampilkan belum wajib zakat
        }
    }

    public function maal(Request $request)
    {
        $setting = Setting::firstWhere('id', 1);

        $harga_emas         = $setting->harga_emas; // harga emas saat ini
        $nishab             = 85; // 85 gram emas
        $kadar              = 2.5 / 100; // kadar zakat 2.5%
        $wajib_zakat        = $harga_emas * $nishab;

        $nilai_tabungan     = $request->nilai_tabungan; // Nilai deposito/tabungan/giro
        $nilai_properti     = $request->nilai_properti; // Nilai properti & kendaraan
        $nilai_emas_dll     = $request->nilai_emas_dll; // Nilai emas, perak, permata, atau sejenisnya
        $nilai_harta_lain   = $request->nilai_harta_lain; // Nilai harga lainnya
        $nilai_hutang       = $request->nilai_hutang; // Hutang pribadi yang jatuh tempo tahun ini
        $total              = $nilai_tabungan + $nilai_properti + $nilai_emas_dll + $nilai_harta_lain - $nilai_hutang;

        if ($total >= $wajib_zakat) {
            $zakat = $total * $kadar;
            return response()->json($zakat); // tampilkan nilai zakat
        } else {
            return response()->json('Belum Wajib Zakat'); // tampilkan belum wajib zakat
        }
    }

    public function perdagangan(Request $request)
    {
        $setting = Setting::firstWhere('id', 1);

        $harga_emas     = $setting->harga_emas; // harga emas saat ini
        $nishab         = 85; // 85 gram emas
        $kadar          = 2.5 / 100; // kadar zakat 2.5%
        $wajib_zakat    = $harga_emas * $nishab;

        $modal          = $request->modal; // Modal 1 tahun
        $keuntungan     = $request->keuntungan; // Keuntungan 1 tahun
        $hutang_rugi    = $request->hutang_rugi; // Hutang / kerugian 1 Tahun
        $hutang         = $request->hutang; // Hutang jatuh tempo tahun ini
        $piutang        = $request->piutang; // Piutang dagang tahun ini
        $total          = $modal + $keuntungan + $piutang - $hutang_rugi - $hutang;

        if ($total >= $wajib_zakat) {
            $zakat = $total * $kadar; // tampilkan nilai zakat
            return response()->json($zakat); // tampilkan nilai zakat
        } else {
            return response()->json('Belum Wajib Zakat'); // tampilkan belum wajib zakat
        }
    }

    public function simpanan(Request $request)
    {
        $setting = Setting::firstWhere('id', 1);

        $harga_emas     = $setting->harga_emas; // harga emas saat ini
        $nishab         = 85; // 85 gram emas
        $kadar          = 2.5 / 100; // kadar zakat 2.5%
        $wajib_zakat    = $harga_emas * $nishab;

        $tabungan       = $request->tabungan; // Saldo tabungan 1 tahun
        $bagi_hasil     = $request->bagi_hasil; // Bagi hasil 1 tahun
        $total          = $tabungan - $bagi_hasil;

        if ($total >= $wajib_zakat) {
            $zakat = $total * $kadar;
            return response()->json($zakat); // tampilkan nilai zakat
        } else {
            return response()->json('Belum Wajib Zakat'); // tampilkan belum wajib zakat
        }
    }

    public function transaksi($bayarzakat)
    {
        return view('frontend.zakattransaksi', [
            'title_bar' => 'Bayar Zakat',
        ]);
    }
}
