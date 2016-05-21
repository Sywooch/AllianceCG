<?php 

use yii\bootstrap\Nav;
use yii\helpers\Html;
use yii\helpers\Url;
// use app\modules\admin\Module;
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
                'label' => FA::icon('cog') . ' ' . Yii::t('app', 'NAV_ADMIN'),
                'url' => '/admin',
                // 'options' => ['class' => 'list-group-item'],
            ],
            [
                'label' => FA::icon('user') . ' ' . Yii::t('app', 'ADMIN_USERS'),
                'url' => '/admin/users',
                // 'options' => ['class' => 'list-group-item'],

            ],
            [
                'label' => FA::icon('cog') . ' ' . Yii::t('app', 'NAV_USERROLES'),
                'url' => '/admin/userroles',
            ],
            [
                'label' => FA::icon('cog') . ' ' . Yii::t('app', 'TRANSLATIONS'),
                'url' => '/admin/sourcemessage',
            ],
        ]),
    ])
    : false;  

?>

</div>    