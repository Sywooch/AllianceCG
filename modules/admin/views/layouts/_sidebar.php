<?php

use yii\bootstrap\Nav;
use yii\helpers\Html;
use yii\helpers\Url;
use app\modules\admin\Module;

    echo Nav::widget([
        'options' => ['class' => 'nav nav-pills nav-stacked'],
        'encodeLabels' => false,
        'items' => array_filter([
            [
                'label' => 'Администрирование',
                'url' => '/admin',
            ],
            [
                'label' => Module::t('module', 'ADMIN_USERS'),
                'url' => '/admin/users',
            ],
            [
                'label' => Module::t('module', 'ADMIN_COMPANIES'),
                'url' => '/admin/companies',
            ],
            [
                'label' => Module::t('module', 'ADMIN_POSITIONS'),
                'url' => '/admin/positions',
            ],
        ]),
    ]);
    ?>