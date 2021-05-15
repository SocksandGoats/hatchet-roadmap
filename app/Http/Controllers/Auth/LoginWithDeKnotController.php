<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginWithDeKnotController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('deknot')->redirect();
    }

    public function callback()
    {
        $user = Socialite::driver('deknot')->user();

        Auth::login(User::createUserFromDeKnot($user), true);

        return redirect()->to(RouteServiceProvider::HOME);
    }
}
