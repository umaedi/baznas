<?php

namespace App\Http\Controllers\Amil;

use App\Exports\TotalzakatExport;
use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class TotalzakatController extends Controller
{
    public function export()
    {
        $invoice = Invoice::query();

        if (\request()->category) {
            $invoice->where('category_id', request()->category);
        }

        if (\request()->bulan) {
            $invoice->where('bulan', request()->bulan);
        }

        if (\request()->tahun) {
            $invoice->where('tahun', request()->tahun);
        }

        $invoice = $invoice->where('payment_status', 2)->whereNotNull('kwitansi')->get();

        return Excel::download(new TotalzakatExport($invoice), 'data-zakat-keseluruhan-' . Carbon::now() . '.xlsx');
    }
}
