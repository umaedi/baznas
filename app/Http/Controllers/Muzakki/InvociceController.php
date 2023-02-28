<?php

namespace App\Http\Controllers\Muzakki;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvociceController extends Controller
{
    public function index()
    {
        $invoice = Invoice::with(['muzakki'])->where('muzakki_id', auth()->guard('muzakki')->user()->id)
            ->where('status', '0')->first();
        return view('muzakki.invoice.index', [
            'invoice'   => $invoice,
            'title'     => 'Invoice'
        ]);
    }

    public function store(Request $request)
    {
        $muzakki_id = auth()->guard('muzakki')->user()->id;
        $invoice = Invoice::with(['muzakki'])->where('muzakki_id', $muzakki_id)
            ->where('status', '0')->first();

        if ($invoice) {

            $date = date('H:i:s');
            $moon = date('n');
            $year = date('Y');

            $inv = Invoice::where('muzakki_id', $muzakki_id)->where('status', '0')->first();

            if ($request->category_id == 'null') {
                $category_id = $inv->category_id;
            } else {
                $category_id = $request->category_id;
            };

            $inv->update([
                'muzakki_id'    => $muzakki_id,
                'category_id'   => $category_id,
                'nominal'       => $request->nominal ? $request->nominal : $inv->nominal,
                'jam'           => $date,
                'bulan'         => $moon,
                'tahun'         => $year,
                'status'        => '0'
            ]);
            return redirect('/muzakki/invoice');
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

        Invoice::create([
            'muzakki_id'    => $muzakki_id,
            'category_id'   => $request->category_id,
            'nominal'       => $request->nominal,
            'jam'           => $date,
            'bulan'         => $moon,
            'tahun'         => $year,
            'status'        => '0'
        ]);

        return redirect('/muzakki/invoice');
    }
}
