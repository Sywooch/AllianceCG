<?php

use yii\helpers\ArrayHelper;
 
$params = ArrayHelper::merge(
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);
 
return [
    'name' => 'Монитор готовности Skoda',
    'language' => 'ru',
    'basePath' => dirname(__DIR__),
    'bootstrap' => [
        'log',
        'app\modules\admin\Bootstrap',
        'app\modules\main\Bootstrap',
        'app\modules\user\Bootstrap',
        'app\modules\alliance\Bootstrap',
        'app\modules\skoda\Bootstrap',
        ],
    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Module',
            'layoutPath' => '@app/modules/admin/views/layouts',
            'layout' => 'main'
        ],    
        'main' => [
            'class' => 'app\modules\main\Module',
            'layoutPath' => '@app/modules/main/views/layouts',
            'layout' => 'main'
        ],
        'alliance' => [
            'class' => 'app\modules\alliance\Module',
            'layoutPath' => '@app/modules/alliance/views/layouts',
            'layout' => 'main'
        ],
        'skoda' => [
            'class' => 'app\modules\skoda\Module',
            'layoutPath' => '@app/modules/skoda/views/layouts',
            'layout' => 'main'
        ],
        'user' => [
            'class' => 'app\modules\user\Module',
            'layoutPath' => '@app/modules/user/views/layouts',
            'layout' => 'main'
        ],
    ],    
    'components' => [
//        'ldap' => [
//            'class' => 'app\components\ldap\Ldap',
//            'ldaphost' => '10.18.123.17',
//            'ldapport' => '389',
//        ],
        'ldap' => [
            'class' => '',
            'ldaphost' => '',
            'ldapport' => '',
        ],        
        'db' => [
            'class' => 'yii\db\Connection',
            'charset' => 'utf8',
        ],
        'i18n' => [
            'translations' => [
                'app' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'forceTranslation' => true,
                ],
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
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
             'transport' => [
                 'class' => 'Swift_SmtpTransport',
                 'host' => 'mail.gorodavto.com',  // e.g. smtp.mandrillapp.com or smtp.gmail.com
                 'username' => 'it.service@alians-kmv.ru',
                 'password' => 'As12zx',
                 'port' => '25', // Port 25 is a very common port too
                 // 'encryption' => 'tls', // It is often used, check your provider or mail server specs
             ],            
        ],
        // 'cache' => [
        //     'class' => 'yii\caching\DummyCache',
        // ],
        // 'cache' => [
        //     'class' => 'yii\caching\DbCache',
        //     'db' => 'db',
        //     'cacheTable' => '{{%cache}}',
        // ],
        'log' => [
            'class' => 'yii\log\Dispatcher',
        ],
    ],
    'params' => $params,
];
