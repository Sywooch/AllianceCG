<?php

return [
    'components' => [
        'request' => [
            'cookieValidationKey' => 'jshd3qjaxp',
        ],
        'assetManager' => [
            'linkAssets' => true,
        ],
        'log' => [
            'targets' => [
                'db' => [
                    'class' => 'yii\log\DbTarget', 
                    'logTable' => '{{%logging}}',
                    'levels' => ['info', 'error', 'warning'],              
                ],
                [
                    'class' => 'yii\log\EmailTarget',
                    'levels' => ['error'],
                    'categories' => ['yii\db\*'],
                    'message' => [
                       'from' => ['FROM_EMAIL'],
                       'to' => ['TO_EMAIL'],
                       'subject' => 'EMAIL_SUBJECT',
                    ],
                ],

                // [
                //     'class' => 'yii\log\FileTarget',
                //     'levels' => ['error'],
                //     'logFile' => '@app/runtime/logs/web-error.log'
                // ],
                // [
                //     'class' => 'yii\log\FileTarget',
                //     'levels' => ['warning'],
                //     'logFile' => '@app/runtime/logs/web-warning.log'
                // ],
            ],
        ],
    ],
];