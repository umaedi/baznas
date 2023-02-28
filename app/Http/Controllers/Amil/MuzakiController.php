<?php

namespace App\Http\Controllers\Amil;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Invoice;
use App\Models\Muzakki;
use Illuminate\Http\Request;

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
            $tahun = \request()->get('tahun', date('Y'));

            if (\request('category')) {
                $invoice->where('category_id', \request()->category);
            }

            if (\request('bulan')) {
                $invoice->where('bulan', \request()->bulan);
            }

            $data['table'] = $invoice->where('muzakki_id', $id)->where('tahun', $tahun)->paginate($page);
            return view('amil.invoice._data_table', $data);
        }

        $muzakki = Muzakki::findOrfail($id);
        $categories = Category::select('id', 'nama_kategori')->get();
        $title = 'Detail Muzakki';
        return view('amil.muzakki.show', compact('muzakki', 'title', 'categories'));
    }
}
