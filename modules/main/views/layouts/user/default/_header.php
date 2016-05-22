<?php

use rmrevin\yii\fontawesome\FA;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\helpers\Url;
use app\modules\user\Module;

    NavBar::begin([
        'brandLabel' => Html::img('@web/img/logo/alliance_logo.png', ['height'=>'55']),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-fixed-top navbar-primary',
        ],
    ]);

    echo $this->render('@app/modules/main/views/layouts/_shared_header');
    
    NavBar::end();
    ?>