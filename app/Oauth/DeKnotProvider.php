<?php namespace App\Oauth;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Laravel\Socialite\Two\AbstractProvider;
use Laravel\Socialite\Two\ProviderInterface;
use Laravel\Socialite\Two\User;

class DeKnotProvider extends AbstractProvider implements ProviderInterface
{
    protected function getAuthUrl($state)
    {
        return $this->buildAuthUrlFromBase('https://deknot.io/oauth/authorize', $state);
    }

    protected function getTokenUrl()
    {
        return 'https://deknot.io/oauth/token';
    }

    protected function getUserByToken($token)
    {
        $response = Http::withToken($token)
            ->withHeaders(['Accept' => 'application/json'])
            ->get('https://deknot.io/api/user');

        $user = $response->json();

        $user['is_verified'] = !empty(Arr::get($user, 'email_verified_at'));

        return $user;
    }

    protected function mapUserToObject(array $user)
    {
        return (new User)->setRaw($user)->map([
            'id'    => $user['id'],
            'name'  => Arr::get($user, 'name'),
            'email' => Arr::get($user, 'email')
        ]);
    }
}
