<?php

return [
    'placetopay' => [
        'login' => env('PLACETOPAY_LOGIN'),
        'secret_key' => env('PLACETOPAY_SECRET_KEY'),
        'url' => env('PLACETOPAY_URL', 'https://checkout-co.placetopay.dev/'),
    ],
    'paypal' => [
        'login' => env('PLACETOPAY_LOGIN'),
        'secret_key' => env('PLACETOPAY_SECRET_KEY'),
        'url' => env('PLACETOPAY_URL', 'https://checkout-co.placetopay.dev/'),
    ],
];
