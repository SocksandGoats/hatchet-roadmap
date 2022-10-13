<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginWithMainAppController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('main_app')->redirect();
    }

    public function callback()
    {
        $user = Socialite::driver('main_app')->user();

        Auth::login(User::createUserFromMainApp($user), true);

        return redirect()->to(RouteServiceProvider::HOME);
    }
}
