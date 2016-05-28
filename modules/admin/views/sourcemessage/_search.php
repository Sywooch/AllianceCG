<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use rmrevin\yii\fontawesome\FA;
use yii\web\View;
use yii\helpers\Url;
use app\modules\admin\models\form\UploadForm;
use yii\bootstrap\Progress;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\SourceMessageSearch */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="source-message-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>


<?= $form->field($model, 'globalSearch', [
        'template' => '<div class="input-group"><span class="input-group-addon"> ' . FA::icon('search') . ' </span>{input}<span class="input-group-btn">'.
            Html::submitButton(Yii::t('app', '{icon} Search', ['icon' => FA::icon('search')]), ['class' => 'btn btn-primary']).'</span></div>',
    ]); 
?> 

    <?php ActiveForm::end(); ?>

</div>



<?php
// echo Progress::widget([
//     'percent' => 65,
//     'barOptions' => ['class' => 'progress-bar-danger']
// ]);
?>