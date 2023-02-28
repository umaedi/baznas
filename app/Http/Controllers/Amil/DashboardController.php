<?php

namespace App\Http\Controllers\Amil;

use App\Http\Controllers\Controller;
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
        $muzakkis = Muzakki::count();
        $invoices = Invoice::where('status', '2')->orWhere('status', '3')->count();
        return view('amil.dashboard.index', compact('muzakkis', 'invoices'));
    }
}
