<?php
$config = [
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['manager', 'head', 'admin', 'root'],
        ],
        'user' => [
            'identityClass' => 'app\modules\user\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => ['user/default/login'],
        ],
];
 
if (YII_ENV_DEV) {
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';
 
    $config['bootstrap'][] = 'gii';
}
 
return $config;