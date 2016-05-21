<?php 

use yii\bootstrap\Nav;
use yii\helpers\Html;
use yii\helpers\Url;
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
                'label' => Yii::t('app', '{icon} NAV_REFERENCES', ['icon' => FA::icon('book')]),
                'url' => '/references',
                // 'options' => ['class' => 'list-group-item'],
            ],
            [
                'label' => Yii::t('app', '{icon} REFERENCES_EMPLOYEES', ['icon' => FA::icon('user')]),
                'url' => '/references/employees',
                // 'options' => ['class' => 'list-group-item'],

            ],
            [
                'label' => Yii::t('app', '{icon} REFERENCES_REGIONS', ['icon' => FA::icon('asterisk')]),
                'url' => '/references/regions',
                // 'visible' => Yii::$app->user->can('admin'),
            ],
            [
                'label' => Yii::t('app', '{icon} REFERENCES_TARGETS', ['icon' => FA::icon('diamond')]),
                'url' => '/references/targets',
                // 'options' => ['class' => 'list-group-item'],

            ],
            [
                'label' => Yii::t('app', '{icon} REFERENCES_BRANDS', ['icon' => FA::icon('car')]),
                'url' => '/references/brands',
                // 'visible' => Yii::$app->user->can('admin'),
            ],
            [
                'label' => Yii::t('app', '{icon} REFERENCES_MODELS', ['icon' => FA::icon('car')]),
                'url' => '/references/models',
                // 'visible' => Yii::$app->user->can('admin'),
            ],
            [
                'label' => Yii::t('app', '{icon} REFERENCES_BODYTYPES', ['icon' => FA::icon('car')]),
                'url' => '/references/bodytypes',
                // 'visible' => Yii::$app->user->can('admin'),
            ],
            [
                'label' => Yii::t('app', '{icon} ADMIN_POSITIONS', ['icon' => FA::icon('briefcase')]),
                'url' => '/references/positions',
                // 'options' => ['class' => 'list-group-item'],
            ],
            [
                'label' => Yii::t('app', '{icon} ADMIN_DEPARTMENTS', ['icon' => FA::icon('users')]),
                'url' => '/references/departments',
                // 'options' => ['class' => 'list-group-item'],
            ],
            [
                'label' => Yii::t('app', '{icon} ADMIN_COMPANIES', ['icon' => FA::icon('institution')]),
                'url' => '/references/companies',
                // 'options' => ['class' => 'list-group-item'],
            ],
            [
                'label' => Yii::t('app', '{icon} CONTACTTYPE', ['icon' => FA::icon('male')]),
                'url' => '/references/contacttype',
                // 'options' => ['class' => 'list-group-item'],
            ],
        ]),
    ])
    : false;  

?>

</div>    