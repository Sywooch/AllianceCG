<?php

use app\modules\admin\models\User;
use app\modules\admin\Module;
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
            $model->isNewRecord ? '<span class="glyphicon glyphicon-floppy-saved"></span>  ' . Module::t('module', 'BUTTON_CREATE') : '<span class="glyphicon glyphicon-pencil"></span>  ' . Module::t('module', 'ADMIN_USERS_BUTTON_UPDATE'),
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']
        ) ?>
        <?= Html::a('<span class="glyphicon glyphicon-floppy-remove"></span>  ' . Module::t('module', 'ADMIN_USERS_BUTTON_CANCEL'), ['/admin/users'], ['class' => 'btn btn-danger']) ?>
    </div>
    
    <?= $form->field($model, 'surname', ['template'=>' <div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>{input}</div>{error}'])->textInput(['placeholder' => $model->getAttributeLabel( 'surname' )]) ?>

    <?= $form->field($model, 'name', ['template'=>' <div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>{input}</div>{error}'])->textInput(['placeholder' => $model->getAttributeLabel( 'name' )]) ?>

    <?= $form->field($model, 'patronymic', ['template'=>' <div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>{input}</div>{error}'])->textInput(['placeholder' => $model->getAttributeLabel( 'patronymic' )]) ?>
    
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

    <?=  $form->field($model, 'role', ['template'=>'<div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-briefcase"></span></span>{input}</div>{error}'])->dropDownList(User::getRolesArray(),['prompt'=>'-- ' . $model->getAttributeLabel( 'role' ) . ' --']); ?>

    <?= $form->field($model, 'email', ['template'=>' <div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-inbox"></span></span>{input}</div>{error}'])->textInput(['placeholder' => $model->getAttributeLabel( 'email' )]) ?>

    <?= $form->field($model, 'newPassword', ['template'=>' <div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>{input}</div>{error}'])->passwordInput(['placeholder' => $model->getAttributeLabel( 'newPassword' )]) ?>

    <?= $form->field($model, 'newPasswordRepeat', ['template'=>' <div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>{input}</div>{error}'])->passwordInput(['placeholder' => $model->getAttributeLabel( 'newPasswordRepeat' )]) ?>
    
    <?= $form->field($model, 'file')->fileInput() ?>

    <?php
        echo $form->field($model, 'status')->radioList(User::getStatusesArray())
    ?>

 
    <?php ActiveForm::end(); ?>
 
</div>
