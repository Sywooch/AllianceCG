<?php

use app\modules\admin\models\User;
use app\modules\admin\models\Userroles;
use app\modules\references\models\Positions;
use app\modules\references\models\Companies;
use app\modules\references\models\Departments;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use rmrevin\yii\fontawesome\FA;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\user\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form center-block">
 
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>    
    
    <?= $form->field($model, 'surname', ['template'=>' <div class="input-group"><span class="input-group-addon"> ' . FA::icon('user') . ' </span>{input}</div>{error}'])->textInput(['placeholder' => $model->getAttributeLabel( 'surname' )]) ?>

    <?= $form->field($model, 'name', ['template'=>' <div class="input-group"><span class="input-group-addon"> ' . FA::icon('user') . ' </span>{input}</div>{error}'])->textInput(['placeholder' => $model->getAttributeLabel( 'name' )]) ?>

    <?= $form->field($model, 'patronymic', ['template'=>' <div class="input-group"><span class="input-group-addon"> ' . FA::icon('user') . ' </span>{input}</div>{error}'])->textInput(['placeholder' => $model->getAttributeLabel( 'patronymic' )]) ?>
    
    <?php
        $pos = Positions::find()->where(['<>', 'state', Positions::STATUS_BLOCKED])->all();
    
        $items = ArrayHelper::map($pos,'id','position');
        $params = [
            'prompt' => '-- ' . $model->getAttributeLabel( 'position' ) . ' --',
        ];
        echo $form->field($model, 'position', ['template'=>'<div class="input-group"><span class="input-group-addon"> ' . FA::icon('briefcase') . ' </span>{input}</div>{error}'])->dropDownList($items,$params);
    ?>

    
    <?php
        $companies = Companies::find()->all();
    
        $items = ArrayHelper::map($companies,'id','company_name');
        $params = [
            'prompt' => '-- ' . $model->getAttributeLabel( 'company' ) . ' --',
        ];
        echo $form->field($model, 'company', ['template'=>'<div class="input-group"><span class="input-group-addon"> ' . FA::icon('institution') . ' </span>{input}</div>{error}'])->dropDownList($items,$params);
    ?>    

    <?php
        $userroles = Userroles::find()->all();
    
        $items = ArrayHelper::map($userroles,'role','role_description');
        $params = [
            'prompt' => '-- ' . $model->getAttributeLabel( 'role' ) . ' --',
        ];
        echo $form->field($model, 'role', ['template'=>'<div class="input-group"><span class="input-group-addon"> ' . FA::icon('briefcase') . ' </span>{input}</div>{error}'])->dropDownList($items,$params);
    ?>  

    <?php
        $departments = Departments::find()->all();
    
        $items = ArrayHelper::map($departments,'id','department_name');
        $params = [
            'prompt' => '-- ' . $model->getAttributeLabel( 'department' ) . ' --',
        ];
        echo $form->field($model, 'department', ['template'=>'<div class="input-group"><span class="input-group-addon"> ' . FA::icon('briefcase') . ' </span>{input}</div>{error}'])->dropDownList($items,$params);
    ?>    

    <?php //  $form->field($model, 'role', ['template'=>'<div class="input-group"><span class="input-group-addon"> ' . FA::icon('briefcase') . ' </span>{input}</div>{error}'])->dropDownList(User::getRolesArray(),['prompt'=>'-- ' . $model->getAttributeLabel( 'role' ) . ' --']); ?>

    <?= $form->field($model, 'email', ['template'=>' <div class="input-group"><span class="input-group-addon"> ' . FA::icon('inbox') . ' </span>{input}</div>{error}'])->textInput(['placeholder' => $model->getAttributeLabel( 'email' )]) ?>

    <?= $form->field($model, 'newPassword', ['template'=>' <div class="input-group"><span class="input-group-addon"> ' . FA::icon('user-secret') . ' </span>{input}</div>{error}'])->passwordInput(['placeholder' => $model->getAttributeLabel( 'newPassword' )]) ?>

    <?= $form->field($model, 'newPasswordRepeat', ['template'=>' <div class="input-group"><span class="input-group-addon"> ' . FA::icon('user-secret') . ' </span>{input}</div>{error}'])->passwordInput(['placeholder' => $model->getAttributeLabel( 'newPasswordRepeat' )]) ?>
        
    <?= $form->field($model, 'file', ['template'=>' <div class="input-group"><span class="input-group-addon"> ' . FA::icon('photo') . ' </span>{input}</div>{error}'])->fileInput() ?>

    <?= $form->field($model, 'status', ['template'=>'<div class="input-group"><span class="input-group-addon"> ' . FA::icon('check-circle-o') . ' </span>{input}</div>{error}'])->dropDownList(User::getStatusesArray()) ?>



    <div class="form-group" style="text-align: right;">
        <?= Html::submitButton(
            $model->isNewRecord ? Yii::t('app', '{icon} BUTTON_CREATE', ['icon' => FA::icon('floppy-o')]) : Yii::t('app', '{icon} ADMIN_USERS_BUTTON_UPDATE', ['icon' => FA::icon('pencil')]),
            ['class' => $model->isNewRecord ? 'btn btn-success btn-sm' : 'btn btn-primary btn-sm']
        ) ?>
        <?= Html::a(Yii::t('app', '{icon} ADMIN_USERS_BUTTON_CANCEL', ['icon' => FA::icon('remove')]), ['/admin/users'], ['class' => 'btn btn-danger btn-sm']) ?>
    </div>

 
    <?php ActiveForm::end(); ?>
 
</div>
