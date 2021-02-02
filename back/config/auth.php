<?php

return [


    'defaults' => [
        'guard' => 'api',
        'passwords' => 'admins',
    ],



    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        'api' => [
            'driver' => 'jwt',
            'provider' => 'admins',
            'hash' => false,
        ],
    ],


    'providers' => [
        'admins' => [
            'driver' => 'eloquent',
            'model' => App\Admins::class,
        ],
    ],


    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],



    'password_timeout' => 10800,

];