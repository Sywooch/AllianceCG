<?php

use app\modules\admin\models\User;
use app\modules\admin\Module;
use app\modules\admin\models\Positions;
use app\modules\admin\models\Companies;
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

    <h1><span class="glyphicon glyphicon-user" style='padding-right:10px;'></span><?= Html::encode($this->title) ?></h1>    

    <div class="form-group" style="text-align: right;">
        <?= Html::submitButton(
            $model->isNewRecord ? FA::icon('floppy-o') . Module::t('module', 'BUTTON_CREATE') : FA::icon('pencil') . Module::t('module', 'ADMIN_USERS_BUTTON_UPDATE'),
            ['class' => $model->isNewRecord ? 'btn btn-success btn-sm' : 'btn btn-primary btn-sm']
        ) ?>
        <?= Html::a(FA::icon('remove') . Module::t('module', 'ADMIN_USERS_BUTTON_CANCEL'), ['/admin/users'], ['class' => 'btn btn-danger btn-sm']) ?>
    </div>
    
    <?= $form->field($model, 'surname', ['template'=>' <div class="input-group"><span class="input-group-addon"> ' . FA::icon('user') . ' </span>{input}</div>{error}'])->textInput(['placeholder' => $model->getAttributeLabel( 'surname' )]) ?>

    <?= $form->field($model, 'name', ['template'=>' <div class="input-group"><span class="input-group-addon"> ' . FA::icon('user') . ' </span>{input}</div>{error}'])->textInput(['placeholder' => $model->getAttributeLabel( 'name' )]) ?>

    <?= $form->field($model, 'patronymic', ['template'=>' <div class="input-group"><span class="input-group-addon"> ' . FA::icon('user') . ' </span>{input}</div>{error}'])->textInput(['placeholder' => $model->getAttributeLabel( 'patronymic' )]) ?>
    
    <?php
        $pos = Positions::find()->all();
    
        $items = ArrayHelper::map($pos,'position','position');
        $params = [
            'prompt' => '-- ' . $model->getAttributeLabel( 'position' ) . ' --',
        ];
        echo $form->field($model, 'position', ['template'=>'<div class="input-group"><span class="input-group-addon"> ' . FA::icon('briefcase') . ' </span>{input}</div>{error}'])->dropDownList($items,$params);
    ?>

    
    <?php
        $companies = Companies::find()->all();

        foreach ($companies as $arr) {
            $arr->merge_companies = $arr->company_name . ' (' . $arr->company_brand . ')';
        }
    
        $items = ArrayHelper::map($companies,'company_name','merge_companies');
        $params = [
            'prompt' => '-- ' . $model->getAttributeLabel( 'company' ) . ' --',
        ];
        echo $form->field($model, 'company', ['template'=>'<div class="input-group"><span class="input-group-addon"> ' . FA::icon('institution') . ' </span>{input}</div>{error}'])->dropDownList($items,$params);
    ?>    

    <?=  $form->field($model, 'role', ['template'=>'<div class="input-group"><span class="input-group-addon"> ' . FA::icon('briefcase') . ' </span>{input}</div>{error}'])->dropDownList(User::getRolesArray(),['prompt'=>'-- ' . $model->getAttributeLabel( 'role' ) . ' --']); ?>

    <?= $form->field($model, 'email', ['template'=>' <div class="input-group"><span class="input-group-addon"> ' . FA::icon('inbox') . ' </span>{input}</div>{error}'])->textInput(['placeholder' => $model->getAttributeLabel( 'email' )]) ?>

    <?= $form->field($model, 'newPassword', ['template'=>' <div class="input-group"><span class="input-group-addon"> ' . FA::icon('user-secret') . ' </span>{input}</div>{error}'])->passwordInput(['placeholder' => $model->getAttributeLabel( 'newPassword' )]) ?>

    <?= $form->field($model, 'newPasswordRepeat', ['template'=>' <div class="input-group"><span class="input-group-addon"> ' . FA::icon('user-secret') . ' </span>{input}</div>{error}'])->passwordInput(['placeholder' => $model->getAttributeLabel( 'newPasswordRepeat' )]) ?>
        
    <?= $form->field($model, 'file', ['template'=>' <div class="input-group"><span class="input-group-addon"> ' . FA::icon('photo') . ' </span>{input}</div>{error}'])->fileInput() ?>

    <?=  $form->field($model, 'status', ['template'=>'<div class="input-group"><span class="input-group-addon"> ' . FA::icon('check-circle-o') . ' </span>{input}</div>{error}'])->dropDownList(User::getStatusesArray()) ?>

 
    <?php ActiveForm::end(); ?>
 
</div>
