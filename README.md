# Socialite for Login with Amazon

https://login.amazon.com/

## Installation
```
composer require revolution/socialite-amazon
```

### config/services.php

```
    'amazon' => [
        'client_id'     => env('AMAZON_LOGIN_ID'),
        'client_secret' => env('AMAZON_LOGIN_SECRET'),
        'redirect'      => env('AMAZON_LOGIN_REDIRECT'),
    ],
```

### .env
```
AMAZON_LOGIN_ID=
AMAZON_LOGIN_SECRET=
AMAZON_LOGIN_REDIRECT=
```

## Usage

routes/web.php
```
Route::get('/', 'AmazonController@index');
Route::get('callback', 'AmazonController@callback');
```

AmazonController

```php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;

class AmazonController extends Controller
{
    public function index()
    {
        return Socialite::driver('amazon')->redirect();
    }

    public function callback()
    {
        $user = Socialite::driver('amazon')->user();
        dd($user);
    }
}

```

## LICENCE
MIT
Copyright (c) 2017 kawax
