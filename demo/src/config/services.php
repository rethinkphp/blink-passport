<?php
return [
    'request' => [
        'class' => \blink\http\Request::class,
        'middleware' => [],
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
        'expires' => 3600 * 24 * 15,
        'storage' => [
            'class' => 'blink\session\FileStorage',
            'path' => __DIR__ . '/../../runtime/sessions'
        ]
    ],
    'auth' => [
        'class' => 'blink\auth\Auth',
        'model' => 'app\models\User',
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
];
