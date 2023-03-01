<?php

namespace App\Http\Controllers\Muzakki;

use App\Models\Muzakki;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        return view('muzakki.register.index');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'       => 'required',
            'email'      => 'required|unique:muzakkis',
            'password'   => 'required',
        ]);
        Muzakki::create([
            'name'       => $request->name,
            'email'      => $request->email,
            'password'   => $request->password,
        ]);

        return redirect('/')->with('success', 'Pendaftaran Berhasil Silakan Login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'     => 'required',
            'password'  => 'required'
        ]);

        $muzakki = Muzakki::where([
            'email'     => $request->email,
            'password'  => $request->password
        ])->first();

        if (!$muzakki) {
            return back()->with('error', 'Login gagal, pastikan email dan password benar!');
        }

        //login the user
        auth()->guard('muzakki')->login($muzakki, $request->remember);

        //rediriect to dashboard
        return redirect('/muzakki/dashboard');
    }

    public function destroy(Request $request)
    {
        Auth::guard('muzakki')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
