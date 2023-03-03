<?php

namespace App\Http\Controllers\Amil;

use App\Models\Invoice;
use App\Models\Muzakki;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        $muzakkis = Muzakki::count();
        $invoices = Invoice::where('payment_status', '2')->whereNotNull('kwitansi')->count();
        return view('amil.dashboard.index', compact('muzakkis', 'invoices'));
    }
}
