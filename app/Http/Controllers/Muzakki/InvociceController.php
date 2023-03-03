<?php

namespace App\Http\Controllers\Muzakki;

use App\Models\Invoice;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Midtrans\CreateSnapTokenService;

class InvociceController extends Controller
{
    public function index()
    {
        $invoice = Invoice::with(['muzakki'])->where('muzakki_id', auth()->guard('muzakki')->user()->id)->where('payment_status', '1')->first();

        return view('muzakki.invoice.index', [
            'invoice'   => $invoice,
            'title'     => 'Invoice'
        ]);
    }

    public function store(Request $request)
    {
        $muzakki_id = auth()->guard('muzakki')->user()->id;
        $invoice = Invoice::with(['muzakki'])->where('muzakki_id', $muzakki_id)->where('payment_status', '1')->first();

        if ($invoice) {

            $date = date('H:i:s');
            $moon = date('n');
            $year = date('Y');
            $no_invoice =  strtoupper(Str::random('6'));

            $invoice->update([
                'muzakki_id'    => $muzakki_id,
                'category_id'   => $request->category_id ? $request->category_id : $invoice->category_id,
                'no_invoice'    => $no_invoice,
                'snap_token'    => $invoice->snap_token,
                'nominal'       => str_replace('.', '', $request->nominal ? $request->nominal : $invoice->nominal),
                'jam'           => $date,
                'bulan'         => $moon,
                'tahun'         => $year,
                'payment_status'        => $invoice->payment_status
            ]);

            //token 
            $midtrans = new CreateSnapTokenService($invoice);
            $snapToken = $midtrans->getSnapToken();

            return redirect()->to('/muzakki/invoice?snapToken=' . $snapToken);
        }

        $request->validate([
            'nominal'   => 'required'
        ]);

        if ($request->category_id == 'null') {
            return back()->with('error', 'Mohon pilih kategori zakat');
        }

        $muzakki_id = auth()->guard('muzakki')->user()->id;
        $date = date('H:i:s');
        $moon = date('n');
        $year = date('Y');
        $no_invoice = strtoupper(Str::random('6'));

        $invoice = Invoice::create([
            'muzakki_id'    => $muzakki_id,
            'category_id'   => $request->category_id,
            'no_invoice'    => $no_invoice,
            'snap_token'    => 'null',
            'nominal'       => str_replace('.', '', $request->nominal),
            'jam'           => $date,
            'bulan'         => $moon,
            'tahun'         => $year,
            'payment_status' => '1'
        ]);

        //token 
        $midtrans = new CreateSnapTokenService($invoice);
        $snapToken = $midtrans->getSnapToken();

        $invoice->snap_token = $snapToken;
        $invoice->save();

        return redirect()->to('/muzakki/invoice?snapToken=' . $snapToken);
    }
}
