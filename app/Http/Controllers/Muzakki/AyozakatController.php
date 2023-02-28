<?php

namespace App\Http\Controllers\Muzakki;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AyozakatController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $title = 'Ayo zakat';
        return view('muzakki.qrcode.index', compact('title'));
    }
}
