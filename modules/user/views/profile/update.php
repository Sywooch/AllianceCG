<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use app\modules\user\Module;
 
/* @var $this yii\web\View */
/* @var $model app\modules\user\models\User */
 
$this->title = Module::t('module', 'PROFILE_TITLE_UPDATE');
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'PROFILE_TITLE_PROFILE'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-profile-update">
 
 
    <div class="user-form col-lg-5 col-lg-offset-3">
 
        <?php $form = ActiveForm::begin(); ?>
        
        <h1>
        <?php
            // Html::encode($this->title) 
        ?>
        </h1>
         
         <div class="form-group" style="text-align: right">
            <?= Html::submitButton('<span class="glyphicon glyphicon-floppy-saved"></span>  ' . Module::t('module', 'PROFILE_BUTTON_SAVE'), ['class' => 'btn btn-primary']) ?>
            <?= Html::a('<span class="glyphicon glyphicon-floppy-remove"></span>  ' . Module::t('module', 'PROFILE_BUTTON_CANCEL'), ['/user/profile'], ['class' => 'btn btn-danger']) ?>
        </div>
        
        <h1><span class="glyphicon glyphicon-user" style='padding-right:10px;'></span><?= $model->getAllname(); ?></h1> 
 
        <?php
            // $form->field($model, 'surname')->textInput(['maxlength' => true]) 
        ?>
        
        <?= $form->field($model, 'surname', ['template'=>' <div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>{input}{error}'])->textInput(['placeholder' => $model->getAttributeLabel( 'surname' )]) . '</div>' ?>
        
        <?php
            // $form->field($model, 'name')->textInput(['maxlength' => true]) 
        ?>
        
        <?= $form->field($model, 'name', ['template'=>' <div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>{input}{error}'])->textInput(['placeholder' => $model->getAttributeLabel( 'name' )]) . '</div>' ?>
        
        <?php
            // $form->field($model, 'patronymic')->textInput(['maxlength' => true]) 
        ?>
        
        <?= $form->field($model, 'patronymic', ['template'=>' <div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>{input}{error}'])->textInput(['placeholder' => $model->getAttributeLabel( 'patronymic' )]) . '</div>' ?>
        
        <?php
            // $form->field($model, 'email')->textInput(['maxlength' => true]) 
        ?>
        
        <?= $form->field($model, 'email', ['template'=>' <div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-inbox"></span></span>{input}{error}'])->textInput(['placeholder' => $model->getAttributeLabel( 'email' )]) . '</div>' ?>
  
        <?php ActiveForm::end(); ?>
            
            <div class="alert alert-danger">
                <?= Module::t('module', 'PROFILE_UPDATE_INFO') ?>
            </div>            
 
    </div>
 
</div>