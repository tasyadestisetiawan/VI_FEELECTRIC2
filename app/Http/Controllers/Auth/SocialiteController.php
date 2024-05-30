<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\SocialAccount;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProvideCallback($provider)
    {
        // Get User
        try {
            $user = Socialite::driver($provider)->stateless()->user();
        } catch (Exception $e) {
            return redirect()->back();
        }

        // Find user
        $authUser = $this->findOrCreateUser($user, $provider);

        // Login User
        auth()->login($authUser, true);

        // Redirect to User Dashboard
        return redirect()->route('user.dashboard');
    }

    public function findOrCreateUser($socialUser, $provider)
    {
        // Get Social Account
        $socialAccount = SocialAccount::where('provider_id', $socialUser->getId())
            ->where('provider_name', $provider)
            ->first();

        // If Social Account exists
        if ($socialAccount) {
            return $socialAccount->user;
        } else {

            // Find User by Email
            $user = User::where('email', $socialUser->getEmail())->first();

            // Create Username (get from getname with lowercase)
            $username = strtolower(str_replace(' ', '', $socialUser->getName()));

            // If User not exists, create new user
            if (!$user) {
                $user = User::create([
                    'name'      => $socialUser->getName(),
                    'username'  => $username,
                    'email'     => $socialUser->getEmail(),
                    'phone'     => null,
                    'address'   => null,
                ]);
            }

            // Save Social Account
            $user->socialAccounts()->create([
                'provider_id'   => $socialUser->getId(),
                'provider_name' => $provider
            ]);

            // Return User
            return redirect()->route('user.dashboard');
        }
    }
}
