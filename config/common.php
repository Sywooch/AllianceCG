<?php

use yii\helpers\ArrayHelper;
 
$params = ArrayHelper::merge(
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);
 
return [
    'name' => 'ГК "Альянс"',
    'language' => 'ru-RU',
    'basePath' => dirname(__DIR__),
    'bootstrap' => [
        'log',
        'app\modules\admin\Bootstrap',
        'app\modules\main\Bootstrap',
        'app\modules\user\Bootstrap',
        'app\modules\alliance\Bootstrap',
        'app\modules\skoda\Bootstrap',
        'app\modules\references\Bootstrap',
        ],
    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Module',
            'layoutPath' => '@app/modules/main/views/layouts',
            'layout' => 'main'
        ],    
        'main' => [
            'class' => 'app\modules\main\Module',
            'layoutPath' => '@app/modules/main/views/layouts',
            'layout' => 'main'
        ],
        'alliance' => [
            'class' => 'app\modules\alliance\Module',
            'layoutPath' => '@app/modules/main/views/layouts',
            'layout' => 'main'
        ],
        'skoda' => [
            'class' => 'app\modules\skoda\Module',
            'layoutPath' => '@app/modules/main/views/layouts/skoda',
            'layout' => 'main'
        ],
        'user' => [
            'class' => 'app\modules\user\Module',
            'layoutPath' => '@app/modules/main/views/layouts',
            'layout' => 'main'
        ],
        'references' => [
            'class' => 'app\modules\references\Module',
            'layoutPath' => '@app/modules/main/views/layouts',
            'layout' => 'main'
        ],
    ],    
    'components' => [
        'ldap' => [
            'class' => '',
            'host' => '',
            'port' => '',
            'rdn' => '',
            'password' => '',
            'dn' => '',
            'filter' => '',
            'attributes' => '',
        ],
        'authManager' => [
            'class' => '',
            'defaultRoles' => [],
        ],
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\DbMessageSource',
                    'sourceMessageTable'=>'{{%source_message}}',
                    'messageTable'=>'{{%message}}',
                    // 'language' => 'ru-RU',
                    // 'sourceLanguage' => 'ru-RU',
                    // 'db' => 'db',
                    'enableCaching' => false,
                    'cachingDuration' => 10,
                    'forceTranslation'=>true,
                ]
            ],
        ],
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '' => 'main/default/index',
                'contact' => 'main/contact/index',
                '<_a:error>' => 'main/default/<_a>',
                '<_a:(login|logout|signup|confirm-email|request-password-reset|reset-password)>' => 'user/default/<_a>',
                
                '<_m:[\w\-]+>/<_c:[\w\-]+>/<id:\d+>' => '<_m>/<_c>/view',
                '<_m:[\w\-]+>/<_c:[\w\-]+>/<id:\d+>/<_a:[\w\-]+>' => '<_m>/<_c>/<_a>',
                '<_m:[\w\-]+>' => '<_m>/default/index',
                '<_m:[\w\-]+>/<_c:[\w\-]+>' => '<_m>/<_c>/index',
            ],
        ],
        'log' => [
            'class' => 'yii\log\Dispatcher',
        ],
    ],
    'params' => $params,
];
