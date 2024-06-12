<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Socialite as ModelSocialite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class ProviderController extends Controller
{
    public function redirect($provider)
    {
        if (Auth::check()) {
            $user = Auth::user();

            if ($user->provider_token) {
                return redirect('/');
            }
        }

        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        $socialUser = Socialite::driver($provider)->stateless()->user();

        $authuser = $this->store($socialUser, $provider);

        Auth::login($authuser);

        return redirect('/dashboard');
    }

    public function store($socialUser, $provider)
    {
        $socialAccount = ModelSocialite::where('provider_id', $socialUser->getId())->where('provider_name', $provider)->first();

        if (!$socialAccount) {
            $user = User::where('email', $socialUser->getEmail())->first();

            if (!$user) {
                $user = User::updateOrCreate([
                    'name' => $socialUser->getName() ? $socialUser->getName() : $socialUser->getNicname(),
                    'email' => $socialUser->getEmail(),
                    'password' => Hash::make('admin'),
                    'phone' => null,
                    'avatar' => $socialUser->getAvatar(),
                ]);
            }

            $user->socialite()->create([
                'provider_id' => $socialUser->getId(),
                'provider_name' => $provider,
                'provider_token' => $socialUser->token,
                'provider_refresh_token' => $socialUser->refreshToken,
            ]);

            return $user;
        }
        return $socialAccount->user;
    }
}
