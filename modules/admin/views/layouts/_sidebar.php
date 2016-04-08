<?php

use yii\bootstrap\Nav;
use yii\helpers\Html;
use yii\helpers\Url;
use app\modules\admin\Module;
use rmrevin\yii\fontawesome\FA;

    echo Nav::widget([
        'options' => ['class' => 'nav nav-list'],
        'encodeLabels' => false,
        'items' => array_filter([
            [
                'label' => FA::icon('cog') . ' ' . 'Dash',
                'url' => '/admin',
            ],
            [
                'label' => FA::icon('user') . ' ' . Module::t('module', 'ADMIN_USERS'),
                'url' => '/admin/users',
            ],
            [
                'label' => FA::icon('institution') . ' ' . Module::t('module', 'ADMIN_COMPANIES'),
                'url' => '/admin/companies',
            ],
            [
                'label' => FA::icon('briefcase') . ' ' . Module::t('module', 'ADMIN_POSITIONS'),
                'url' => '/admin/positions',
            ],
        ]),
    ]);
    ?>