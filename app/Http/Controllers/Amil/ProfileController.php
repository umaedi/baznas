<?php

namespace App\Http\Controllers\Amil;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        return view('amil.profile.index');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'      => 'required',
            'email'     => 'required',
            'no_tlp'    => 'required'
        ]);

        $user = User::findOrfail($id);
        if ($request->file('image')) {

            $image = $request->file('image');
            $image->storeAs('public/image/profille', $image->hashName());
            Storage::disk('local')->delete('public/image/profille/' . basename($user->image));
        } else {
            $image = '';
        }

        $user->update([
            'name'      => $request->name,
            'email'     => $request->email,
            'no_tlp'    => $request->no_tlp,
            'password'  => $request->password ? bcrypt($request->password) : $user->password,
            'image'     => $image ? $image->hashName() : $user->image
        ]);

        return back()->with('success', 'Profile berhasil diupdate');
    }
}
