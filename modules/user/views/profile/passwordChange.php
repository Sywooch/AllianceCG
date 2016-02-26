<?php
 
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use app\modules\user\Module;
 
/* @var $this yii\web\View */
/* @var $model app\modules\user\models\ChangePasswordForm */
 
$this->title = Module::t('module', 'PROFILE_TITLE_PASSWORD_CHANGE');
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'PROFILE_TITLE_PROFILE'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-profile-password-change">
 
    <div class="user-form col-lg-offset-3">
        
        <div class="form-group" style="text-align: right">
            <?= Html::submitButton('<span class="glyphicon glyphicon-floppy-saved"></span>  ' . Module::t('module', 'PROFILE_BUTTON_SAVE'), ['class' => 'btn btn-primary']) ?>
            <?= Html::a('<span class="glyphicon glyphicon-floppy-remove"></span>  ' . Module::t('module', 'PROFILE_BUTTON_CANCEL'), ['/user/profile'], ['class' => 'btn btn-danger']) ?>
        </div>
        
        <h1><?= Html::encode($this->title) ?></h1> 
        
        <?php $form = ActiveForm::begin(); ?>
 
        <?php
        // $form->field($model, 'currentPassword')->passwordInput(['maxlength' => true])
        ?>
        <?= $form->field($model, 'currentPassword', ['template'=>' <div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>{input}</div>{error}'])->textInput(['placeholder' => $model->getAttributeLabel( 'currentPassword' )]) ?>
        <?php
        // $form->field($model, 'newPassword')->passwordInput(['maxlength' => true])
        ?>
        <?= $form->field($model, 'newPassword', ['template'=>' <div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>{input}</div>{error}'])->textInput(['placeholder' => $model->getAttributeLabel( 'newPassword' )]) ?>
        <?php
        // $form->field($model, 'newPasswordRepeat')->passwordInput(['maxlength' => true])
        ?>
        <?= $form->field($model, 'newPasswordRepeat', ['template'=>' <div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>{input}</div>{error}'])->textInput(['placeholder' => $model->getAttributeLabel( 'newPasswordRepeat' )]) ?>

 
        <?php ActiveForm::end(); ?>
 
    </div>
 
</div>