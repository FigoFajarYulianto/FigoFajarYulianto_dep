<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Dana;
use App\Models\Danafund;
use App\Models\Danafunditem;
use App\Models\Jenisdana;
use App\Models\Jenisdanafund;
use App\Models\Jenisdanafunditem;
use App\Models\Zakat;
use App\Models\Zakatfund;
use App\Models\Zakattransactionitem;
use App\Services\Midtrans\CreateSnapTokenService;

class ZakattransactionController extends Controller
{
    public function penghasilan($nominal, $slug)
    {
        return view('frontend.zakattransaksi', [
            'title_bar'    => 'Transaksi Zakat',
            'nominal'      => $nominal,
            'dana'         => Dana::with('danacategory')->firstWhere('slug', $slug),
        ]);
    }

    public function store_topup(Request $request)
    {
        $data = $request->validate([
            'dana_id'           => ['required'],
            'danacategory_id'   => ['required'],
            'gross_amount'      => ['required'],
            'name'              => ['required'],
            'alamat'            => ['required'],
            'phone'             => ['required'],
            'is_anonim'         => ['required'],
            'description'       => ['required'],
            'transaction_type'  => ['required'],
        ]);
        $order_id = time();
        $data['order_id'] = $order_id;
        $data['jml_hari'] = $request->jml_hari;
        $data['transaction_status'] = 'Menunggu';
        $data['transaction_time'] = date('Y-m-d H:i:s');
        $data['email'] = $request->email;

        $snapToken = $order_id;
        $midtrans = new CreateSnapTokenService($data);
        $snapToken = $midtrans->getSnapToken();
        $data['snap_token'] = $snapToken;

        $tanggal = date('Y-m-d');

        $datadana = Dana::where('id', $request->dana_id)->first()->code;
        $code = $datadana;
        $data['no_transaksi'] = Danafunditem::generateInv($code, $tanggal);

        $create = Danafunditem::create($data);

        if ($create) {
            return response()->json(['status' => true, 'data' => $create]);
        } else {
            return response()->json(['status' => false]);
        }
    }

    public function update_topup(Request $request, Danafunditem $danafunditem)
    {
        $data = $request->validate([
            'transaction_status_time'   => ['required'],
            'transaction_status'        => ['required'],
        ]);

        if ($request->transaction_status == 'pending') {
            $data['transaction_status'] = 'Menunggu';
            $update = Danafunditem::where('id', $danafunditem->id)->update($data);
            if ($update) {
                return response()->json(['status' => true, 'data' => $update]);
            } else {
                return response()->json(['status' => false]);
            }
        } else if ($request->transaction_status == 'failure') {
            $data['transaction_status'] = 'Gagal';
            $update = Danafunditem::where('id', $danafunditem->id)->update($data);
            if ($update) {
                return response()->json(['status' => true, 'data' => $update]);
            } else {
                return response()->json(['status' => false]);
            }
        } else if ($request->transaction_status == 'settlement') {
            $data['transaction_status'] = 'Berhasil';
            $update = Danafunditem::where('id', $danafunditem->id)->update($data);

            $danafund['dana_id'] = $danafunditem->dana_id;
            $danafund['total_fund'] = (Danafund::where('dana_id', $danafunditem->dana_id)->first()->total_fund ?? 0) + $danafunditem->gross_amount;

            if (Danafund::where('dana_id', $danafunditem->dana_id)->first() == '') {
                $danafund['sisa_fund'] = (Danafund::where('dana_id', $danafunditem->dana_id)->first()->total_fund ?? 0) + $danafunditem->gross_amount;
                Danafund::create($danafund);
            } else {
                $danafund['sisa_fund'] = (Danafund::where('dana_id', $danafunditem->dana_id)->first()->sisa_fund ?? 0) + $danafunditem->gross_amount;
                Danafund::where('dana_id', $danafunditem->dana_id)->update($danafund);
            }

            if ($update) {
                return response()->json(['status' => true, 'data' => $update]);
            } else {
                return response()->json(['status' => false]);
            }
        }
    }
}
