<?php

namespace App\Http\Controllers\Muzakki;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Invoice;

class RiwayatzakatController extends Controller
{
    public function index()
    {
        if (\request()->ajax()) {
            $page = request()->get('pagination', 12);
            $data = [];

            $invoice = Invoice::query();

            $invoice->where('muzakki_id', auth()->guard('muzakki')->user()->id)->first();

            if (request()->category != '') {
                $invoice->where('category_id', \request()->category);
            }

            $data['table'] = $invoice->where('payment_status', '2')->latest()->paginate($page);
            return view('muzakki.riwayatzakat._table_data', $data);
        }

        $categories = Category::select('id', 'nama_kategori')->get();
        $title = 'Riwayat Zakat';
        return view('muzakki.riwayatzakat.index', compact('categories', 'title'));
    }
}
