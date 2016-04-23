<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use rmrevin\yii\fontawesome\FA;
use app\modules\alliance\Module;
use yii\widgets\Pjax;

?>

<?php
    $this->registerJs(
        '$("document").ready(function(){
                $("#new_note").on("pjax:end", function() {
                $.pjax.reload({container:"#comments"});
            });            
        });'
    );
?>


<div class="comments-form">
    
<?php yii\widgets\Pjax::begin(['id' => 'new_note']) ?>
    <?php $form = ActiveForm::begin([
            'options' => ['data-pjax' => true],
            'id' => 'comments-form',
        ]); 
    ?>

    <?= $form->errorSummary($model); ?>
    
    <?= $form->field($model, 'comment_text', [
                'template' => '<div class="input-group"><span class="input-group-addon"> ' . FA::icon('comment') . ' </span>{input}<span class="input-group-addon"> ' . Html::submitButton(Module::t('module', 'CREDITCALENDAR_COMMENT_BUTTON'), ['class' => 'btn-link']) . ' </span></div>',
        ])->textArea([
                'rows' => 4,
                'placeholder' => $model->getAttributeLabel( 'comment_text' )
            ]);
    
    ?>

    <div class="form-group">
        <?php // Html::submitButton(Yii::t('app', 'Create'), ['class' => 'btn btn-success']); ?>
    </div>

    <?php ActiveForm::end(); ?>
    <?php Pjax::end(); ?>

</div>