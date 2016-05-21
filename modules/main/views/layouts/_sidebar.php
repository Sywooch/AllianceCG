<?php

use yii\bootstrap\Nav;
use yii\helpers\Html;
use yii\helpers\Url;
use rmrevin\yii\fontawesome\FA;
use yii\bootstrap\Collapse;
 
// Yii::$app->controller->module->id;

    echo Collapse::widget([
        'id' => 'sidebar',
        'options' => [
                'class' => 'collapse-test',
                'style' => 'margin-top: 0',
                ],
        'encodeLabels' => false,
        'items' => [
            [
                'label' => FA::icon('building') . ' ' . Yii::t('app', 'NAV_ALLIANCE'),
                'content' => $this->render('_allianceContent'),
                'contentOptions' => [
                    'class' => Yii::$app->controller->module->id == 'alliance' ? 'in' : false,
                ],
                'options' => ['style' => !Yii::$app->user->can('creditcalendarIsVisible') ? 'display: none;' : false,],
            ],
            [
                'label' => FA::icon('wrench') . ' ' . Yii::t('app', 'NAV_SKODA'),
                'content' => $this->render('_skodaContent'),
                'contentOptions' => [
                    'class' => Yii::$app->controller->module->id == 'skoda' ? 'in' : false,
                ],
                'options' => ['style' => !Yii::$app->user->can('skodaIsVisible') ? 'display: none;' : false,],
            ],
            [
                'label' => FA::icon('book') . ' ' . Yii::t('app', 'NAV_REFERENCES'),
                'content' => $this->render('_referencesContent'),
                'contentOptions' => [
                    'class' => Yii::$app->controller->module->id == 'references' ? 'in' : false,
                ],
                'options' => ['style' => !Yii::$app->user->can('creditcalendarIsVisible') ? 'display: none;' : false,],
            ],
            [
                'label' => FA::icon('cog') . ' ' . Yii::t('app', 'NAV_ADMIN'),
                'content' => $this->render('_adminContent'),
                'contentOptions' => [
                    'class' => Yii::$app->controller->module->id == 'admin' ? 'in' : false,
                ],
                'options' => ['style' => !Yii::$app->user->can('admin') ? 'display: none;' : false,],
            ],
        ]
    ]);     

?>