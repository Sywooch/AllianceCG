<?php

use app\modules\admin\models\User;
use app\modules\admin\models\Positions;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\user\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form center-block">
 
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>    

    <h1><span class="glyphicon glyphicon-user" style='padding-right:10px;'></span><?= Html::encode($this->title) ?></h1>    

    <div class="form-group" style="text-align: right;">
        <?= Html::submitButton(
            $model->isNewRecord ? '<span class="glyphicon glyphicon-floppy-saved"></span>  ' . Yii::t('app', 'BUTTON_CREATE') : '<span class="glyphicon glyphicon-pencil"></span>  ' . Yii::t('app', 'BUTTON_UPDATE'),
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']
        ) ?>
        <?= Html::a('<span class="glyphicon glyphicon-floppy-remove"></span>  ' . Yii::t('app', 'BUTTON_CANCEL'), ['/admin/users'], ['class' => 'btn btn-danger']) ?>
    </div>
    
    
    <?php 
        // $form->field($model, 'surname')->textInput(['maxlength' => true])
    ?>
    <?= $form->field($model, 'surname', ['template'=>' <div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>{input}</div>{error}'])->textInput(['placeholder' => $model->getAttributeLabel( 'surname' )]) ?>

    <?php
        // $form->field($model, 'name')->textInput(['maxlength' => true])
    ?>
    <?= $form->field($model, 'name', ['template'=>' <div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>{input}</div>{error}'])->textInput(['placeholder' => $model->getAttributeLabel( 'name' )]) ?>

    <?php
        // $form->field($model, 'patronymic')->textInput(['maxlength' => true]) 
    ?>
    <?= $form->field($model, 'patronymic', ['template'=>' <div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>{input}</div>{error}'])->textInput(['placeholder' => $model->getAttributeLabel( 'patronymic' )]) ?>

    <?php 
        // $form->field($model, 'position')->textInput(['maxlength' => true])
    ?>
    <?php
        // $form->field($model, 'position', ['template'=>' <div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-briefcase"></span></span>{input}</div>{error}'])->textInput(['placeholder' => $model->getAttributeLabel( 'position' )]) 
    ?>
    
    <?php
        $pos = Positions::find()->all();
    
        $items = ArrayHelper::map($pos,'position','position');
        $params = [
            'prompt' => '-- ' . $model->getAttributeLabel( 'position' ) . ' --',
            // 'template'=>' <div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>{input}</div>{error}'
            // 'template'=>'{input}{error}}',
        ];
        echo $form->field($model, 'position', ['template'=>'<div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-briefcase"></span></span>{input}</div>{error}'])->dropDownList($items,$params);
    ?>
    
    <?php
    // $form->field($model, 'username')->textInput(['maxlength' => true])
    ?>
 
    <?php
    // $form->field($model, 'email')->textInput(['maxlength' => true]) 
    ?>
    <?= $form->field($model, 'email', ['template'=>' <div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-inbox"></span></span>{input}</div>{error}'])->textInput(['placeholder' => $model->getAttributeLabel( 'email' )]) ?>
 
    <?php
    // $form->field($model, 'newPassword')->passwordInput(['maxlength' => true]) 
    ?>
    <?= $form->field($model, 'newPassword', ['template'=>' <div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>{input}</div>{error}'])->passwordInput(['placeholder' => $model->getAttributeLabel( 'newPassword' )]) ?>
 
    <?php
        // $form->field($model, 'newPasswordRepeat')->passwordInput(['maxlength' => true]) 
    ?>
    <?= $form->field($model, 'newPasswordRepeat', ['template'=>' <div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>{input}</div>{error}'])->passwordInput(['placeholder' => $model->getAttributeLabel( 'newPasswordRepeat' )]) ?>
 
    <?php
        // echo $form->field($model, 'status')->dropDownList(User::getStatusesArray())
    ?>
    
    <?= $form->field($model, 'file')->fileInput() ?>

    <?php
        echo $form->field($model, 'status')->radioList(User::getStatusesArray())
    ?>

 
    <?php ActiveForm::end(); ?>
 
</div>
