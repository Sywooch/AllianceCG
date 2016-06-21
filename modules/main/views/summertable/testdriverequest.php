<?php 

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>


<?php $form = ActiveForm::begin(); ?>

<?php echo $form->field($model, 'name', [
        'template' => '<div class="input-group"><span class="input-group-addon"><i class="fa fa-user"></i></span>{input}{error}'.
            '<span class="input-group-addon">Ф.И.О.</span></div>',
    ])->textInput() ?>

<?php // echo $form->field($model, 'phone')->textInput() ?>

<!-- <br /><br /> -->

<?php 
	echo $form->field($model, 'phone', [
        	'template' => '<div class="input-group"><span class="input-group-addon"><i class="fa fa-phone"></i></span>{input}{error}'.
            '<span class="input-group-addon">Тел.</span></div>',
    	])->widget(\yii\widgets\MaskedInput::className(), [
    		'mask' => '+7 (999) 999-99-99',
	])
?>

<?php echo $form->field($model, 'selectedcar', [
        'template' => '<div class="input-group"><span class="input-group-addon"><i class="fa fa-car"></i></span>{input}{error}'.
            '<span class="input-group-addon">А/М</span></div>',
    ])->textInput(['readonly' => true]) ?>


    <div class="form-group buttonpane">
        <?= Html::submitButton(Yii::t('app', '{icon} TESTDRIVEREQUEST', ['icon' => '<i class="fa fa-send"></i>']), ['class' => 'btn btn-primary btn-sm']) ?>
    </div>    

<?php ActiveForm::end(); ?>