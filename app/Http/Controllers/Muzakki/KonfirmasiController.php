<?php

namespace App\Http\Controllers\Muzakki;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;

class KonfirmasiController extends Controller
{
    public function index()
    {
        return view('muzakki.konfirmasi.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'struk' => 'required|image|file|max:2048'
        ]);

        $invoice = Invoice::where('muzakki_id', auth()->guard('muzakki')->user()->id)->where('payment_status', '1')->first();

        if ($invoice) {
            $struk = $request->file('struk');
            $struk->storeAs('public/image/struk', $struk->hashName());

            $invoice->update([
                'struk'    => $struk->hashName(),
                'payment_status'   => '2'
            ]);

            return back()->with('success', 'Struk Pembayaran Berhasil Di Unggah');
        } else {
            return back()->with('error', 'Tidak ada pembayaran yang perlu di konfirmasi!');
        }
    }
}
