<?php
$config = [
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['manager', 'head', 'admin', 'root'],
        ],
        'user' => [
            // 'identityClass' => 'app\modules\user\models\User',
            'identityClass' => 'app\modules\user\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => ['user/default/login'],
        ],
];
 
if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';
 
    $config['bootstrap'][] = 'gii';
    // $config['modules']['gii'] = 'yii\gii\Module';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['127.0.0.1', '::1', '192.168.1.100', '10.18.125.7', '10.18.123.7']
    ];
}
 
return $config;