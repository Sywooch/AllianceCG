<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use rmrevin\yii\fontawesome\FA;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model app\modules\references\models\BodytypesSearch */
/* @var $form yii\widgets\ActiveForm */

$multipleDelete = file_get_contents('js/modules/references/bodytypes/deleteRestore.js');
$this->registerJs($multipleDelete, View::POS_END);

$toggleSearch = file_get_contents('js/modules/references/regions/toggleSearch.js');
$this->registerJs($toggleSearch, View::POS_END);

?>

<div class="buttonpane">

<?= Html::a(Yii::t('app', '{icon} CREATE', ['icon' => '<i class="fa fa-plus"></i>']), ['create'], ['class' => 'btn btn-link animlink']); ?>
        
<?= Html::a(Yii::t('app', '{icon} DELETE', ['icon' => '<i class="fa fa-remove"></i>']), ['#'], ['class' => 'btn btn-link animlink', 'id' => 'MultipleDelete']); ?>
        
<?= Html::a(Yii::t('app', '{icon} RESTORE', ['icon' => '<i class="fa fa-upload"></i>']), ['#'], ['class' => 'btn btn-link animlink', 'id' => 'MultipleRestore']); ?>

<?= Html::a(Yii::t('app', '{icon} REFRESH', ['icon' => '<i class="fa fa-refresh"></i>']), ['index'], ['class' => 'btn btn-link animlink']) ?>

<?= Html::button(Yii::t('app', '{icon} ADVANCED', ['icon' => '<i class="fa fa-file-excel-o"></i>']), ['class' => 'btn-link animlink', 'id' => 'advancedOperations']) ?>

</div>

<div class="col-sm-12 bs-callout bs-callout-info" id="advanced">

    <div class="col-sm-6">

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
    <div class="col-sm-6">
        <?= Html::a(Yii::t('app', '{icon} IMPORT_EXCEL', ['icon' => '<i class="fa fa-upload"></i>']), ['upload'], ['class' => 'btn btn-link animlink']) ?>
        <?= Html::a(Yii::t('app', '{icon} EXPORT_EXCEL', ['icon' => '<i class="fa fa-file-excel-o"></i>']), ['export'], ['class' => 'btn btn-link animlink']) ?>
    </div>
</div>            

