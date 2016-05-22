<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use rmrevin\yii\fontawesome\FA;
 
/* @var $this yii\web\View */
/* @var $model app\modules\user\models\User */
 
$this->title = Yii::t('app', 'PROFILE_TITLE_UPDATE');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'PROFILE_TITLE_PROFILE'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-profile-update">
 
 
    <!-- <div class="user-form col-lg-5 col-lg-offset-3"> -->
    <div>
 
        <?php $form = ActiveForm::begin(); ?>
        
        <h1>
        <?php
            // Html::encode($this->title) 
        ?>
        </h1>
         
         <div class="form-group" style="text-align: right">
            <?= Html::submitButton(Yii::t('app', '{icon} PROFILE_BUTTON_SAVE', ['icon' => FA::icon('edit')]), ['class' => 'btn btn-primary btn-sm']) ?>
            <?= Html::a(Yii::t('app', '{icon} PROFILE_BUTTON_CANCEL', ['icon' => FA::icon('remove')]), ['/user/profile'], ['class' => 'btn btn-danger btn-sm']) ?>
        </div>
        
        <!--<h1>-->
            <!--<span class="glyphicon glyphicon-user" style='padding-right:10px;'></span>-->
                <?php // $model->getAllname(); ?>
        <!--</h1>--> 
 
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
                <?= Yii::t('app', 'PROFILE_UPDATE_INFO') ?>
            </div>            
 
    </div>
 
</div>