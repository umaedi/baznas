<?php

namespace App\Http\Controllers\Muzakki;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Services\Midtrans\CallbackService;

class PaymentCallbackController extends Controller
{
    public function receive()
    {
        $callback = new CallbackService;

        if ($callback->isSignatureKeyVerified()) {
            $notification = $callback->getNotification();
            $order = $callback->getOrder();

            if ($callback->isSuccess()) {
                Invoice::where('id', $order->id)->update([
                    'payment_status' => 2,
                ]);
            }

            if ($callback->isExpire()) {
                Invoice::where('id', $order->id)->update([
                    'payment_status' => 3,
                ]);
            }

            if ($callback->isCancelled()) {
                Invoice::where('id', $order->id)->update([
                    'payment_status' => 4,
                ]);
            }

            return response()
                ->json([
                    'success' => true,
                    'message' => 'Notifikasi berhasil diproses',
                ]);
        } else {
            return response()
                ->json([
                    'error' => true,
                    'message' => 'Signature key tidak terverifikasi',
                ], 403);
        }
    }

    public function success()
    {
        $title = "Pembayaran Sukses";
        return view('muzakki.payment.index', compact('title'));
    }
}
