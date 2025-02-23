<?php
return [
    'user_conf' =>
    ['db' => [
        'dsn' => 'mysql:host=localhost;dbname=ue34_tp2',
        'user' => 'root',
        'password' => '',
    ],
    'roles' => [
        'root_level' => 0,
        'admin_level' => 1,
        'user_level' => 100,
        'guest_level' => 255,
    ]],

    'language_conf' => [
        'default_language' => 'en',
    ],

    'release_conf' =>
        ['db' => [
            'dsn' => 'mysql:host=localhost;dbname=ue34_tp2',
            'user' => 'root',
            'password' => '',
        ],
        'limit_last_articles' => 5,
    ]
];