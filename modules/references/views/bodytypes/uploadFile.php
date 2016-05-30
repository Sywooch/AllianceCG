<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Progress;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model app\modules\references\models\Brands */
/* @var $form yii\widgets\ActiveForm */

$this->title = Yii::t('app', 'UPLOAD_FILE');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'REFERENCES'), 'url' => ['references']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'BODYTYPES'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$toggleSearch = file_get_contents('js/modules/references/regions/toggleProgress.js');
$this->registerJs($toggleSearch, View::POS_END);

?>

<div class="col-lg-8 col-lg-offset-2">

    <?php 
    	$form = ActiveForm::begin([
    		'options' => [
    			'enctype' => 'multipart/form-data',
    		]
    	]); 
    ?>

    <?= $form->field($model, 'xlsxFile')->fileInput(); ?>

	<div class="progressbar" id="progressbar" style="display: none">
		<?= Progress::widget([
			    'percent' => 100,
			    'barOptions' => ['class' => 'progress-bar-danger'],
			    'options' => ['class' => 'active progress-striped']
			]);
		?>
	</div>

    <div class="form-group" style="text-align: center;">
        <?= Html::submitButton(Yii::t('app', '{icon} UPLOAD', ['icon' => '<i class="fa fa-upload"></i>']), ['class' => 'btn btn-primary animlinkColor', 'id' => 'toggleProgressBar']) ?>
        <?= Html::a(Yii::t('app', '{icon} CANCEL', ['icon' => '<i class="fa fa-remove"></i>']), ['index'], ['class' => 'btn btn-danger animlinkColor btn-sm']) ?>
    </div>


    <?php ActiveForm::end(); ?>

</div>


