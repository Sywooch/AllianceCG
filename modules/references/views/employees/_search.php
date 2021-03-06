<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;


/* @var $this yii\web\View */
/* @var $model app\modules\references\models\EmployeesSearch */
/* @var $form yii\widgets\ActiveForm */

$multipleDelete = file_get_contents('js/modules/references/employees/deleteRestore.js');
$this->registerJs($multipleDelete, View::POS_END);

// $toggleSearch = file_get_contents('js/modules/references/employees/toggleSearch.js');
// $this->registerJs($toggleSearch, View::POS_END);


?>


<!-- <div class="col-sm-12 bs-callout bs-callout-info" id="advanced"> -->
<div id="advanced">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'globalSearch', [
            'template' => '<div class="input-group"><span class="input-group-addon"> <i class="fa fa-search"></i> </span>{input}<span class="input-group-btn">'.
                Html::submitButton(Yii::t('app', '{icon} Search', ['icon' => '<i class="fa fa-search"></i>']), ['class' => 'btn btn-primary animlink']).'</span></div>',
        ]); 
    ?>        

    <?php ActiveForm::end(); ?>

</div>     
