<?php

return [
    'components' => [
        'log' => [
            'class' => 'yii\log\DbTarget', 
            'logTable' => '{{%logging}}',
            'levels' => ['trace', 'info', 'error', 'warning'], 
        ],
    ],
];