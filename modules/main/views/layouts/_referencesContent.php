<?php 

use yii\bootstrap\Nav;
use yii\helpers\Html;
use yii\helpers\Url;
use app\modules\admin\Module;
use rmrevin\yii\fontawesome\FA;

?>

<div style="min-width: 100%">

<?php

    echo Yii::$app->user->can('accessCreditReferences') ?
    Nav::widget([
        'options' => ['class' => 'nav nav-stacked'],
        'encodeLabels' => false,
        'items' => array_filter([
            [
                'label' => FA::icon('book') . ' ' . Module::t('module', 'NAV_REFERENCES'),
                'url' => '/references',
                // 'options' => ['class' => 'list-group-item'],
            ],
            [
                'label' => FA::icon('diamond') . ' ' . Module::t('module', 'REFERENCES_TARGETS'),
                'url' => '/references/targets',
                // 'options' => ['class' => 'list-group-item'],

            ],
            [
                'label' => FA::icon('car') . ' ' . Module::t('module', 'REFERENCES_BRANDS'),
                'url' => '/references/brands',
                // 'visible' => Yii::$app->user->can('admin'),
            ],
            [
                'label' => FA::icon('car') . ' ' . Module::t('module', 'REFERENCES_MODELS'),
                'url' => '/references/models    ',
                // 'visible' => Yii::$app->user->can('admin'),
            ],
        ]),
    ])
    : false;  

?>

</div>    