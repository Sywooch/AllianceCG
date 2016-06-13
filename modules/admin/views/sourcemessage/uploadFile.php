<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Progress;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model app\modules\references\models\Brands */
/* @var $form yii\widgets\ActiveForm */

$this->title = Yii::t('app', 'UPLOAD_FILE');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'ADMIN'), 'url' => ['/admin']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'SOURCEMESSAGES'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$toggleSearch = file_get_contents('js/modules/admin/sourcemessage/toggleProgress.js');
$this->registerJs($toggleSearch, View::POS_END);

?>

<div class="col-lg-8 col-lg-offset-2">

<div class="panel panel-default">
    <div class="panel-heading">
        <?php echo Yii::t('app', '{icon} UPLOAD_FILE', ['icon' => '<i class="fa fa-upload"></i>']); ?>
    </div> <!-- panelHeading End -->

    <div class="panel-body">

        <?php 
        	$form = ActiveForm::begin([
        		'options' => [
        			'enctype' => 'multipart/form-data',
        		]
        	]); 
        ?>

        <?php
            echo $form->field($model, 'xlsxFile', ['template' => '{input}{error}'])->fileInput(); 
        ?>

    <div class="progressbar" id="progressbar" style="display: none">

    	<?php 
            echo Progress::widget([
    		    'percent' => 100,
    		    'barOptions' => ['class' => 'progress-bar-danger'],
    		    'options' => ['class' => 'active progress-striped']
    		]);
    	?>

    </div> <!-- progressBar End -->

    </div> <!-- panelBody End -->

    <div class="panel-footer">

        <div class="form-group" style="text-align: center;">
            <?php echo Html::submitButton(Yii::t('app', '{icon} UPLOAD', ['icon' => '<i class="fa fa-upload"></i>']), ['class' => 'btn btn-primary btn-sm animlinkColor', 'id' => 'toggleProgressBar']) ?>
            <?php echo Html::a(Yii::t('app', '{icon} CANCEL', ['icon' => '<i class="fa fa-remove"></i>']), ['index'], ['class' => 'btn btn-danger btn-sm animlinkColor']) ?>
        </div> <!-- form-group End -->

    </div> <!-- panelFooter End -->

    <?php ActiveForm::end(); ?>

</div> <!-- panel End -->

</div> <!-- col-lg-8 col-lg-offset-2 End -->


