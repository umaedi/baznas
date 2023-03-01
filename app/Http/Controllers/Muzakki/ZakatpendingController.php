<?php

namespace App\Http\Controllers\Muzakki;

use App\Models\Invoice;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ZakatpendingController extends Controller
{
    public function index()
    {
        if (\request()->ajax()) {
            $page = request()->get('paginate', 12);
            $data = [];

            $invoice = Invoice::query();

            $invoice->where('muzakki_id', auth()->guard('muzakki')->user()->id)->first();

            if (request()->category != '') {
                $invoice->where('category_id', \request()->category);
            }

            $data['table'] = $invoice->where('payment_status', '1')->orWhere('payment_status', '3')->latest()->paginate($page);
            return view('muzakki.zakatpending._table_data', $data);
        }

        $categories = Category::select('id', 'nama_kategori')->get();
        $title = 'Riwayat Zakat';
        return view('muzakki.zakatpending.index', compact('categories', 'title'));
    }
}
