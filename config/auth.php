<?php

return [

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],
    'admins' => [
        'driver' => 'eloquent',
        'model' => App\Models\Admin::class,
    ],
    'teams' => [
        'driver' => 'eloquent',
        'model' => App\Models\Team::class,
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'teams',
        ],

        'admin' => [
            'driver' => 'session',
            'provider' => 'admins',
        ],

        'team' => [
            'driver' => 'session',
            'provider' => 'teams',
        ],
    ],

    'providers' => [
        'admins' => [
            'driver' => 'eloquent',
            'model' => App\Models\Admin::class,
        ],

        'teams' => [
            'driver' => 'eloquent',
            'model' => App\Models\Team::class,
        ],
    ],
];
