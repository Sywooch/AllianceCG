<?php

return [
    'components' => [
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => [
                'author',
                'skassistant',
                'skmastercons',
                'skservicehead',
                'skdirector',
                'chiefcredit',
                'seniorcreditspecialist',
                'creditmanager',
                'admin',
                'root'
            ],
        ],       
        'db' => [
            'dsn' => 'mysql:host=DB_HOST;dbname=DB_NAME',
            'username' => 'DB_USER',
            'password' => 'DB_PASSWORD',
            'tablePrefix' => 'DB_PREFIX_',
            'class' => 'yii\db\Connection',
        ], 
        'mailer' => [
           'class' => 'yii\swiftmailer\Mailer',
           'viewPath' => '@app/modules/main/mail',
           'useFileTransport' => false,
           'transport' => [
              'class'=>'Swift_SmtpTransport',
              'host'=>'SMTPSERVER',
              'username'=>'EMAILADDRESS',
              'password'=>'EMAILPASSWORD',
              'port'=>'465', // 25, OR 587 (TLS), OR 465 (SSL)
              'encryption'=>'ssl', //TLS, OR SSL, OR FALSE
           ],
       ],
        'cache' => [
            'class' => 'yii\caching\DbCache',
            'db' => 'db',
            'cacheTable' => '{{%cache}}',
        ],
    ],
];