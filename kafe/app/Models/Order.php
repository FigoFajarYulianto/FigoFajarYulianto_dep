<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function orderitems()
    {
        return $this->hasMany(Orderitem::class);
    }

    public function status()
    {
        return $this->belongsTo(Statusorder::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function scopeFilter($query, array $filters)
    {
        $query->when(
            $filters['faktur'] ?? false,
            fn ($query, $search) => $query
                ->where('faktur', 'like', '%' . $search . '%')
        );

        $query->when(
            $filters['meja'] ?? false,
            fn ($query, $search) => $query
                ->where('meja', 'like', '%' . $search . '%')
        );

        $query->when(
            $filters['status_id'] ?? false,
            fn ($query, $search) => $query
                ->where('status_id', 'like', '%' . $search . '%')
        );

        $query->when(($filters['startdate'] ?? false) && ($filters['enddate'] ?? false) ? [$filters['startdate'], $filters['enddate']] : false,
            fn ($query, $dates) => $query->whereDate('created_at', '>=', Carbon::createFromFormat('Y-m-d', $dates[0]))
                ->whereDate('created_at', '<=', Carbon::createFromFormat('Y-m-d', $dates[1]))
        );

        if (isset($filters['status']) && $filters['status'] === '1') {
            $query->where('status', true);
        } else if (isset($filters['status']) && $filters['status'] === '0') {
            $query->where('status', false);
        }

        $query->when(
            $filters['customer'] ?? false,
            fn ($query, $customer) => $query->where('customer_id', $customer)
        );

        $query->when(
            $filters['barang'] ?? false,
            fn ($query, $barang) => $query->whereHas('penjualan_items', fn ($query) => $query->where('barang_id', $barang))
        );
    }


    public static function generateInv($date)
    {
        $number = Order::orderBy('id', 'DESC')->first()->id;
        return str_pad(($number + 1), 5, "0", STR_PAD_LEFT) . '/OD/' . date('dm', strtotime($date)) . substr(date('Y', strtotime($date)), -2);
    }
}
