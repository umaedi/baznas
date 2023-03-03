<?php

namespace App\Http\Controllers\Amil;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;

class KonfirmasizakatController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $id)
    {
        $invoice = Invoice::findOrfail($id);
        $request->validate([
            'kwitansi'  => 'required|image|file|max:2048'
        ]);

        $kwitansi = $request->kwitansi;
        $kwitansi->storeAs('public/image/kwitansi', $kwitansi->hashName());

        $invoice->update([
            'kwitansi'  => $kwitansi->hashName()
        ]);

        return back()->with('success', 'Zakat berhasil dikonfirmasi');
    }
}
