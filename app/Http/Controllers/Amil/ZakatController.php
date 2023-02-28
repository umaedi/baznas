<?php

namespace App\Http\Controllers\Amil;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Invoice;
use Illuminate\Http\Request;

class ZakatController extends Controller
{
    public function index()
    {
        if (\request()->ajax()) {
            $invoice = Invoice::query();
            $invoice->where('status', '1');
            $data['table'] = $invoice->paginate();
            return view('amil.zakat._data_table', $data);
        };
        return view('amil.zakat.index');
    }

    public function show($id)
    {
        if (\request()->ajax()) {
            $invoice = Invoice::findOrfail($id);
            $invoice->update(['status' => \request()->status]);
            return response()->json(\request()->status);
        };

        $data['invoice'] = Invoice::findOrfail($id);
        return view('amil.zakat.show', $data);
    }

    public function zakat_confirm()
    {
        if (\request()->ajax()) {

            $invoice = Invoice::query();

            $page = \request()->get('paginate', 12);
            $status = \request()->get('status', '2');
            $tahun = \request()->get('tahun', date('Y'));

            if (\request('category')) {
                $invoice->where('category_id', \request()->category);
            }

            if (\request('bulan')) {
                $invoice->where('bulan', \request()->bulan);
            }

            $invoice->where('status', $status);

            $data['table'] = $invoice->where('tahun', $tahun)->latest()->paginate($page);
            return view('amil.zakat._data_table_confirm', $data);
        };

        $categories = Category::select('id', 'nama_kategori')->get();
        $title = 'Total Zakat Keseluruhan';
        return view('amil.zakat.dikonfirmasi', compact('categories', 'title'));
    }
}
