<?php

use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\helpers\Url;

    NavBar::begin([
        // 'brandLabel' => getNavbarLogo(),
        // 'brandUrl' => getNavbarBrandUrl(),
        // 'options' => [
        //     'class' => getNavbarCSS(),
        // ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'nav nav-pills nav-stacked'],
        'encodeLabels' => false,
        'items' => array_filter([
            [
                'label' => 'Ссылка 1',
                'url' => '#',
            ],
            [
                'label' => 'Ссылка 2',
                'url' => '#',
            ],
        ]),
    ]);
    NavBar::end();
    ?>