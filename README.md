## Voting App

**Demo:** https://voting.main-app.io

## Installation

1. Clone the repo and `cd` into it
1. `composer install`
1. Rename or copy `.env.example` file to `.env`
1. `php artisan key:generate`
1. Setup a database and add your database credentials in your `.env` file
1. `php artisan migrate` or `php artisan migrate --seed` if you want seed data
1. `npm install`
1. `npm run dev` or `npm run watch`
1. `php artisan serve` or use Laravel Valet
1. Visit `localhost:8000` in your browser
1. Access Nova via `/admin`

## Setup Login With Main App
1. Install Laravel Passport in Oauth Server application: https://laravel.com/docs/8.x/passport
2. Create Passport Client via: `php artisan passport:client` (Read more about Requesting Tokens process: https://laravel.com/docs/8.x/passport#requesting-tokens)
3. Add these env variables into your voting app .env
```
MAIN_APP_NAME="Main App"
MAIN_APP_CLIENT_ID= // Client ID in oauth_clients table of your Oauth Server application.
MAIN_APP_CLIENT_SECRET= // Secret in oauth_clients table of your Oauth Server application.
MAIN_APP_CLIENT_REDIRECT= http://voting.test/main-app/auth/callback // Callback URL of the voting application.
MAIN_APP_PASSPORT_SERVER=https://passport.test // Oauth Server application URL
MAIN_APP_OAUTH_USER_ENDPOINT=api/user // User api endpoint in Oauth Server application.
MAIN_APP_OAUTH_TOKEN_ENDPOINT=oauth/token // Token api endpoint in Oauth Server application.
MAIN_APP_OAUTH_AUTHORIZE_ENDPOINT=oauth/authorize // Oauth authorize endpoint in Oauth Server application.
```
4. Make sure your `api.php` is using Passport (`auth:api`):

```
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
```

Voting app will make a request to that route to get the user information of you Saas app.

5. Customize (Optional)
```
App\Oauth\MainAppPassportProvider.php
App\Http\Controllers\Auth\LoginWithMainAppController.php
```
