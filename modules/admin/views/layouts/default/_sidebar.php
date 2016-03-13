<?php

use yii\bootstrap\Nav;
use yii\helpers\Html;
use yii\helpers\Url;

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
    ?>