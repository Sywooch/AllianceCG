<?php

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

    echo $this->render('@app/modules/main/views/layouts/_shared_header');

    NavBar::end();
    ?>