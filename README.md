## Voting App

**Demo:** https://voting.deknot.io

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

## Setup Login With DeKnot
1. Install Laravel Passport in Oauth Server application: https://laravel.com/docs/8.x/passport
2. Create Passport Client via: `php artisan passport:client` (Read more about Requesting Tokens process: https://laravel.com/docs/8.x/passport#requesting-tokens)
3. Add these env variables into your voting app .env
```
DEKNOT_CLIENT_ID=1 // Client ID in oauth_clients table of your Oauth Server application.
DEKNOT_CLIENT_SECRET= // Secret in oauth_clients table of your Oauth Server application.
DEKNOT_CLIENT_REDIRECT=http://voting.test/deknot/auth/callback // Callback URL of the voting application.
DEKNOT_PASSPORT_SERVER=http://gp.test // Oauth Server application URL
```
4. Customize (Optional)
```
App\Oauth\DeKnotProvider.php
App\Http\Controllers\Auth\LoginWithDeKnotController.php
```
