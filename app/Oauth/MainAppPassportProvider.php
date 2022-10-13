<?php namespace App\Oauth;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Laravel\Socialite\Two\AbstractProvider;
use Laravel\Socialite\Two\ProviderInterface;
use Laravel\Socialite\Two\User;

class MainAppPassportProvider extends AbstractProvider implements ProviderInterface
{
    protected function getAuthUrl($state)
    {
        return $this->buildAuthUrlFromBase(Str::finish(config('voting.main_app_passport_server'), '/') . config('voting.main_app_oauth_authorize_endpoint'), $state);
    }

    protected function getTokenUrl()
    {
        return Str::finish(config('voting.main_app_passport_server'), '/') . config('voting.main_app_oauth_token_endpoint');
    }

    protected function getUserByToken($token)
    {
        $response = Http::withToken($token)
            ->withHeaders(['Accept' => 'application/json'])
            ->get(Str::finish(config('voting.main_app_passport_server'), '/') . config('voting.main_app_oauth_user_endpoint'));

        $user = $response->json();

        $user['is_verified'] = !empty(Arr::get($user, 'email_verified_at'));

        return $user;
    }

    protected function mapUserToObject(array $user)
    {
        return (new User)->setRaw($user)->map([
            'id'    => $user['id'],
            'name'  => Arr::get($user, 'first_name'),
            'email' => Arr::get($user, 'email')
        ]);
    }
}
