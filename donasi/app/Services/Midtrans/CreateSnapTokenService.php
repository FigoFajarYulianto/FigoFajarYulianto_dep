<?php

namespace App\Services\Midtrans;

use Midtrans\Snap;
use App\Models\User;

class CreateSnapTokenService extends Midtrans
{
    protected $order;

    public function __construct($order)
    {
        parent::__construct();
        $this->order = $order;
    }

    public function getSnapToken()
    {
        $params = [
            'transaction_details' => [
                'order_id' => $this->order['order_id'],
                'gross_amount' => $this->order['gross_amount'],
            ],
            'customer_details' => [
                'first_name' => $this->order['name'],
            ]
        ];

        $snapToken = Snap::getSnapToken($params);

        return $snapToken;
    }
}
