<?php

namespace App\Http\Controllers\Muzakki;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Invoice;
use App\Models\Muzakki;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $muzakki = Muzakki::with('dinas')->where('id', auth()->guard('muzakki')->user()->id)->first();
        $categories = Category::select('id', 'nama_kategori')->get();
        $invoices = Invoice::where('muzakki_id', auth()->guard('muzakki')->user()->id)->where('payment_status', '2')->count();
        $pending = Invoice::where('muzakki_id', auth()->guard('muzakki')->user()->id)->where('payment_status', '1')->count();

        return view('muzakki.dashboard.index', [
            'title'         => 'Dashboard',
            'muzakki'       => $muzakki,
            'categories'    => $categories,
            'invoices'      => $invoices,
            'pending'      => $pending,
        ]);
    }
}
