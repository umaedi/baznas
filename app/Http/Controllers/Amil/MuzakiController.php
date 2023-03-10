<?php

namespace App\Http\Controllers\Amil;

use App\Models\Invoice;
use App\Models\Muzakki;
use App\Models\Category;
use App\Exports\MuzakkiExport;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class MuzakiController extends Controller
{
    public function index()
    {
        if (\request()->ajax()) {
            $muzakki = Muzakki::query();

            $page = \request()->get('pagination', 12);

            if (\request()->search) {
                $muzakki->where('name', 'like', '%' . \request()->search . '%');
            }

            if (\request()->category) {
                $muzakki->where('dinas_id', \request()->category);
            }

            $data['table']  = $muzakki->latest()->paginate($page);
            return view('amil.muzakki._data_table_muzakki', $data);
        };

        $title = 'Data List Muzakki';
        return view('amil.muzakki.index', compact('title'));
    }

    public function show($id)
    {
        if (\request()->ajax()) {

            $invoice = Invoice::query();

            $page = \request()->get('pagination', 12);

            if (\request('category')) {
                $invoice->where('category_id', \request()->category);
            }

            if (\request('bulan')) {
                $invoice->where('bulan', \request()->bulan);
            }

            if (\request('tahun')) {
                $invoice->where('tahun', \request()->tahun);
            }

            $data['table'] = $invoice->where('muzakki_id', $id)->where('payment_status', 2)->whereNotNull('kwitansi')->paginate($page);
            return view('amil.invoice._data_table', $data);
        }

        $muzakki = Muzakki::findOrfail($id);
        $categories = Category::select('id', 'nama_kategori')->get();
        $title = 'Detail Muzakki';
        return view('amil.muzakki.show', [
            'id_muzakki'    => $id,
            'muzakki'       => $muzakki,
            'categories'    => $categories,
            'title'         => $title,
        ]);
    }

    public function export(Request $request)
    {
        if ($request->status) {
            $muzakki = Muzakki::with('dinas')->where('dinas_id', $$request->dinas_id)->get();
            return Excel::download(new MuzakkiExport($muzakki), 'data-muzakki-' . Carbon::now() . '.xlsx');
        }

        $muzakki = Muzakki::with('dinas')->get();
        return Excel::download(new MuzakkiExport($muzakki), 'data-muzakki-' . Carbon::now() . '.xlsx');
    }
}
