<?php

use app\modules\admin\models\User;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use rmrevin\yii\fontawesome\FA;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\UserSearch */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="user-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'class' => 'user-search-form'
        ],
    ]); ?>

    <div class="col-sm-7">

    <?= $form->field($model, 'globalSearch', ['template'=>' <div class="input-group"><span class="input-group-addon"> ' . FA::icon('search') . ' </span>{input}</div>{error}'])->textInput(['placeholder' => $model->getAttributeLabel( 'globalSearch' )]) ?>
    
    </div>

    <div class="form-group col-sm-5" style="text-align: right">
        <?= Html::submitButton(Yii::t('app', '{icon} SEARCH', ['icon' => FA::icon('search')]), ['class' => 'btn btn-primary btn-sm']) ?>

        <?= Html::a(Yii::t('app', '{icon} ADMIN_USERS_CREATE', ['icon' => FA::icon('plus')]), ['create'], ['class' => 'btn btn-success btn-sm']) ?>
        
        <?= Html::a(Yii::t('app', '{icon} ADMIN_USERS_REFRESH', ['icon' => FA::icon('refresh')]), ['index'], ['class' => 'btn btn-info btn-sm', 'id' => 'refreshButton']) ?>
    
    </div>

    <?php ActiveForm::end(); ?>

</div>