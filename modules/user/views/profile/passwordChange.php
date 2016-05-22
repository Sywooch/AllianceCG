<?php
 
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use rmrevin\yii\fontawesome\FA;
 
/* @var $this yii\web\View */
/* @var $model app\modules\user\models\ChangePasswordForm */
 
$this->title = Yii::t('app', 'PROFILE_TITLE_PASSWORD_CHANGE');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'PROFILE_TITLE_PROFILE'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-profile-password-change">
 
    <!-- <div class="user-form col-lg-offset-3"> -->
    <div>
        
        <div class="form-group" style="text-align: right">
            <?= Html::submitButton(FA::icon('edit') . ' ' . Yii::t('app', 'PROFILE_BUTTON_SAVE'), ['class' => 'btn btn-primary btn-sm']) ?>
            <?= Html::a(FA::icon('remove') . ' ' . Yii::t('app', 'PROFILE_BUTTON_CANCEL'), ['/user/profile'], ['class' => 'btn btn-danger btn-sm']) ?>
        </div>
        
        <!--<h1>-->
            <?php // Html::encode($this->title) ?>
        <!--</h1>--> 
        
        <?php $form = ActiveForm::begin(); ?>
 
        <?php
        // $form->field($model, 'currentPassword')->passwordInput(['maxlength' => true])
        ?>
        <?= $form->field($model, 'currentPassword', ['template'=>' <div class="input-group"><span class="input-group-addon">' . FA::icon('lock') . '</span>{input}</div>{error}'])->textInput(['placeholder' => $model->getAttributeLabel( 'currentPassword' )]) ?>
        <?php
        // $form->field($model, 'newPassword')->passwordInput(['maxlength' => true])
        ?>
        <?= $form->field($model, 'newPassword', ['template'=>' <div class="input-group"><span class="input-group-addon">' . FA::icon('lock') . '</span>{input}</div>{error}'])->textInput(['placeholder' => $model->getAttributeLabel( 'newPassword' )]) ?>
        <?php
        // $form->field($model, 'newPasswordRepeat')->passwordInput(['maxlength' => true])
        ?>
        <?= $form->field($model, 'newPasswordRepeat', ['template'=>' <div class="input-group"><span class="input-group-addon">' . FA::icon('lock') . '</span>{input}</div>{error}'])->textInput(['placeholder' => $model->getAttributeLabel( 'newPasswordRepeat' )]) ?>

 
        <?php ActiveForm::end(); ?>
 
    </div>
 
</div>