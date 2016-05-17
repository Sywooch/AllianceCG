<?php 

use yii\bootstrap\Nav;
use yii\helpers\Html;
use yii\helpers\Url;
use app\modules\admin\Module;
use rmrevin\yii\fontawesome\FA;

?>

<div style="min-width: 100%">

<?php

    echo Yii::$app->user->can('admin') ?
    Nav::widget([
        'options' => ['class' => 'nav nav-stacked'],
        'encodeLabels' => false,
        'items' => array_filter([
            [
                'label' => FA::icon('cog') . ' ' . Module::t('module', 'NAV_ADMIN'),
                'url' => '/admin',
                // 'options' => ['class' => 'list-group-item'],
            ],
            [
                'label' => FA::icon('user') . ' ' . Module::t('module', 'ADMIN_USERS'),
                'url' => '/admin/users',
                // 'options' => ['class' => 'list-group-item'],

            ],
            [
                'label' => FA::icon('cog') . ' ' . Module::t('module', 'NAV_USERROLES'),
                'url' => '/admin/userroles',
            ],
        ]),
    ])
    : false;  

?>

</div>    