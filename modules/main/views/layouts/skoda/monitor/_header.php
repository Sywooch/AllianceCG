<?php

use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\helpers\Url;



    NavBar::begin([
        'brandLabel' => Html::img('@web/img/logo/skoda_logo.png', ['width'=>'48','height'=>'48']),
        'brandUrl' => Url::toRoute('/skoda'),
        'options' => [
            'class' => 'navbar navbar-fixed-top navbar-skoda',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-left navbar-skoda'],
        'encodeLabels' => false,
        'items' => array_filter([
            [
                'label' => 'Skoda',
                'options' => ['class' => 'disabled bold_grid'],
            ]
        ]),
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right navbar-skoda'],
        'encodeLabels' => false,
        'items' => array_filter([
            [
            	'label' => 'ООО "СтрелаАвто"',
                'options' => ['class' => 'disabled bold_grid'],
            ]
        ]),
    ]);
    NavBar::end();
    ?>