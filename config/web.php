<?php
$config = [
    'id' => 'app',
    'defaultRoute' => 'main/default/index',
    'components' => [
        'formatter' => [
            // 'timeZone' => 'Europe/Moscow',
            // 'timeZone' => 'GMT',
            'timeZone' => 'UTC',
            'dateFormat' => 'yyyy-MM-dd',
            'timeFormat' => 'php:H:i:s',
            'datetimeFormat' => 'yyyy-MM-dd HH:mm',
            'decimalSeparator' => '. ',
            'thousandSeparator' => ' ',
            'currencyCode' => 'EUR',
        ],
        'user' => [
            'identityClass' => 'app\modules\user\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => ['user/default/login'],
        ],
        'errorHandler' => [
            'errorAction' => 'main/default/error',
        ],
        'request' => [
            'cookieValidationKey' => '',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
        ],
    ],
];
 
if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';
 
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['127.0.0.1', '::1', '192.168.1.100', '10.18.125.2', '10.18.123.7', '10.18.123.17']
    ];
}
 
return $config;