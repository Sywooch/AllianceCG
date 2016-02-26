<?php

Yii::setAlias('@tests', dirname(__DIR__) . '/tests');
 
return [
    'id' => 'app-console',
    'bootstrap' => ['gii'],
    'controllerNamespace' => 'app\commands',
    'modules' => [
        'gii' => 'yii\gii\Module',
        'allowedIPs' => ['127.0.0.1', '::1', '192.168.1.100', '10.18.125.7', '10.18.123.7']
    ],
];
