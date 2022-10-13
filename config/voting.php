<?php

return [
    'main_app_name' => env('MAIN_APP_NAME',''),
    'main_app_logo_img_url' => env('MAIN_APP_URL',),
    'main_app_passport_server' => env('MAIN_APP_PASSPORT_SERVER', ''),
    'main_app_oauth_user_endpoint' => env('MAIN_APP_OAUTH_USER_ENDPOINT','api/user'),
    'main_app_oauth_token_endpoint' => env('MAIN_APP_OAUTH_TOKEN_ENDPOINT','oauth/token'),
    'main_app_oauth_authorize_endpoint' => env('MAIN_APP_OAUTH_AUTHORIZE_ENDPOINT','oauth/authorize')

];
