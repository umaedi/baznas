<?php

namespace App\Http\Controllers\Muzakki;

use Exception;
use App\Models\SocialAccount;
use App\Http\Controllers\Controller;
use App\Models\Muzakki;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProvideCallback($provider)
    {
        try {
            $muzakki = Socialite::driver($provider)->user();
        } catch (Exception $e) {
            return redirect()->back();
        }

        $authUser = $this->findOrCreateUser($muzakki, $provider);

        //login the user
        Auth::guard('muzakki')->login($authUser, 'remember', true);
        return redirect('/muzakki/dashboard');
    }

    public function findOrCreateUser($muzakkiProvider, $provider)
    {
        $account = SocialAccount::where(['provider_name' => $provider, 'provider_id' => $muzakkiProvider->id])->first();
        if ($account) {
            return $account->muzakki;
        } else {
            $muzakki = Muzakki::where('email', $muzakkiProvider->email)->first();
            if (!$muzakki) {
                $muzakki = Muzakki::create([

                    'email' => $muzakkiProvider->email,
                    'name'  => $muzakkiProvider->name,
                ]);
            }
            $muzakki->SocialAccount()->create([
                'provider_id'   => $muzakkiProvider->id,
                'provider_name' => $provider,
            ]);
            return $muzakki;
        }
    }
}
