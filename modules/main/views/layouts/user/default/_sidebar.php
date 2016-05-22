<?php

use yii\bootstrap\Nav;
use yii\helpers\Html;
use yii\helpers\Url;
use app\modules\user\Module;

    echo Nav::widget([
        'options' => ['class' => 'nav nav-pills nav-stacked'],
        'encodeLabels' => false,
        'items' => array_filter([
            [
                'label' => Module::t('module', 'PROFILE_TITLE_PROFILE'),
                'url' => '/user/profile',
            ],
            [
                'label' => Module::t('module', 'PROFILE_TITLE_UPDATE'),
                'url' => '/user/profile/update',
            ],
            [
                'label' => Module::t('module', 'PROFILE_LINK_PASSWORD_CHANGE'),
                'url' => '/user/profile/password-change',
            ],
        ]),
    ]);
?>