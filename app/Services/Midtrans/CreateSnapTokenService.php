<?php

namespace App\Services\Midtrans;

use App\Models\Invoice;
use Midtrans\Snap;

class CreateSnapTokenService extends Midtrans
{
    protected $invoice;

    public function __construct($invoice)
    {
        parent::__construct();

        $this->invoice = $invoice;
    }

    public function getSnapToken()
    {
        $params = [
            /**
             * 'order_id' => id order unik yang akan digunakan sebagai "primary key" oleh Midtrans untuk
             * 				 membedakan order satu dengan order lain. Key ini harus unik (tidak boleh ada duplikat).
             * 'gross_amount' => merupakan total harga yang harus dibayar customer.
             */
            'transaction_details' => [
                'order_id' => $this->invoice->no_invoice,
                'gross_amount' => $this->invoice->nominal,
            ],
            /**
             * 'item_details' bisa diisi dengan detail item dalam order.
             * Umumnya, data ini diambil dari tabel `order_items`.
             */
            'item_details' => [
                [
                    'id' => $this->invoice->id,
                    'price' => $this->invoice->nominal,
                    'quantity' => 1,
                    'name' => $this->invoice->category->nama_kategori,
                ],
            ],
            'customer_details' => [
                'Nama Lengkap' => $this->invoice->muzakki->name,
                'email' => $this->invoice->muzakki->email,
                'phone' => $this->invoice->muzakki->email,
            ]
        ];

        $snapToken = Snap::getSnapToken($params);

        return $snapToken;
    }
}
