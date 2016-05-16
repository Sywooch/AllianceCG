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
                'label' => FA::icon('user') . ' ' . Module::t('module', 'REFERENCES_EMPLOYEES'),
                'url' => '/references/employees',
                // 'options' => ['class' => 'list-group-item'],

            ],
            [
                'label' => FA::icon('asterisk') . ' ' . Module::t('module', 'REFERENCES_REGIONS'),
                'url' => '/references/regions',
                // 'visible' => Yii::$app->user->can('admin'),
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
                'url' => '/references/models',
                // 'visible' => Yii::$app->user->can('admin'),
            ],
            [
                'label' => FA::icon('car') . ' ' . Module::t('module', 'REFERENCES_BODYTYPES'),
                'url' => '/references/bodytypes',
                // 'visible' => Yii::$app->user->can('admin'),
            ],
            [
                'label' => FA::icon('briefcase') . ' ' . Module::t('module', 'ADMIN_POSITIONS'),
                'url' => '/references/positions',
                // 'options' => ['class' => 'list-group-item'],
            ],
            [
                'label' => FA::icon('users') . ' ' . Module::t('module', 'ADMIN_DEPARTMENTS'),
                'url' => '/references/departments',
                // 'options' => ['class' => 'list-group-item'],
            ],
        ]),
    ])
    : false;  

?>

</div>    