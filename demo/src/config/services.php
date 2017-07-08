<?php
return [
    'request' => [
        'class' => \blink\http\Request::class,
        'middleware' => [
            \blink\passport\oauth\Authenticator::class,
        ],
    ],
    'response' => [
        'class' => \blink\http\Response::class,
        'middleware' => [],
    ],
    /*
    'errorHandler' => [
        'class' => blink\sentry\ErrorHandler::class
    ],

    'sentry' => [
        'class' => \blink\sentry\Sentry::class,
        'dsn' => 'http://2108c7b41d4c4a8794245e4d17b2ca8e:958dbdcd48a84cf7b813c190fb1889aa@sentry.seiue.com/6',
        'environments' => ['dev'],
    ],
    */
    'session' => [
        'class' => 'blink\session\Manager',
        'sessionClass' => \blink\passport\oauth\AccessToken::class,
        'expires' => 3600 * 24 * 15,
        'storage' => [
            'class' => 'blink\session\FileStorage',
            'path' => __DIR__ . '/../../runtime/sessions'
        ]
    ],
    'auth' => [
        'class' => \blink\passport\oauth\OAuth::class,
        'model' => \blink\passport\models\User::class,
        'privateKey' => __DIR__ . '/private.key',
        'publicKey' => __DIR__ . '/public.key',
    ],
    'log' => [
        'class' => 'blink\log\Logger',
        'targets' => [
            'file' => [
                'class' => 'blink\log\StreamTarget',
                'enabled' => true,
                'stream' => 'php://stderr',
                'level' => 'info',
            ]
        ],
    ],
    'cache' => [
        'class' => \blink\redis\Cache::class,
        'redis' => [
            'class' => \blink\redis\Client::class,
            'servers' => 'tcp://127.0.0.1:6379',
        ],
    ],
];
