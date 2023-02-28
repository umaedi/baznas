<?php

namespace App\Http\Controllers\Muzakki;

use App\Http\Controllers\Controller;
use App\Models\Dinas;
use App\Models\Muzakki;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        return view('muzakki.profile.index', [
            'title'     => 'Profile',
            'status'    => Dinas::select('id', 'nama_dinas')->get(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $muzakki = Muzakki::findOrfail($id);
        if ($request->file('image')) {

            $image = $request->file('image');
            $image->storeAs('public/image/profille', $image->hashName());

            Storage::disk('local')->delete('public/image/profille/' . basename($muzakki->image));
        } else {
            $image = '';
        }

        $muzakki->update([
            'name'      => $request->name,
            'email'     => $request->email,
            'no_tlp'    => $request->no_tlp,
            'dinas_id'  => $request->dinas_id ? $request->dinas_id : $muzakki->dinas_id,
            'password'  => $request->password ? $request->password : $muzakki->password,
            'image'     => $image ? $image->hashName() : $muzakki->image
        ]);

        return redirect('/muzakki/profile')->with('success', 'Profile berhasil di update');
    }
}
