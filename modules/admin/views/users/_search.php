<?php

use app\modules\admin\models\User;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\admin\Module;

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

<h1><span class="glyphicon glyphicon-search" style='padding-right:10px;'></span> <?= Module::t('module', 'ADMIN_SEARCH_TITLE') ?> </h1>

    <?= $form->field($model, 'fullname', ['template'=>' <div class="input-group"><span class="input-group-addon" style="width: 0;"><span class="glyphicon glyphicon-user"></span></span>{input}'])->textInput(['placeholder' => $model->getAttributeLabel( 'fullname' )]) . '</div>' ?>

    <?= $form->field($model, 'position', ['template'=>' <div class="input-group"><span class="input-group-addon" style="width: 0;"><span class="glyphicon glyphicon-briefcase"></span></span>{input}'])->textInput(['placeholder' => $model->getAttributeLabel( 'position' )]) . '</div>' ?>

    <?= $form->field($model, 'email', ['template'=>' <div class="input-group"><span class="input-group-addon" style="width: 0;"><span class="glyphicon glyphicon-inbox"></span></span>{input}'])->textInput(['placeholder' => $model->getAttributeLabel( 'email' )]) . '</div>' ?>    

    <?php
        echo $form->field($model, 'status', ['template' => "<div class=\"radio\">\n{input}\n{error}\n{hint}\n</div>"])->dropDownList(User::getStatusesArray(), ['prompt' => $model->getAttributeLabel('status')]);
    ?>    

    <div class="form-group" style="text-align: left">
        <?= Html::submitButton('<span class="glyphicon glyphicon-search"></span>  ' . Module::t('module', 'ADMIN_USERS_SEARCH'), ['class' => 'btn btn-primary']) ?>

        <?= Html::a('<span class="glyphicon glyphicon-filter"></span>  ' . Module::t('module', 'ADMIN_USERS_CLEAR_FILTER'), ['index'], ['class' => 'btn btn-primary', 'id' => 'refreshButton']) ?>
    
    </div>

    <?php ActiveForm::end(); ?>

</div>