<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use rmrevin\yii\fontawesome\FA;
use yii\helpers\ArrayHelper;
use app\modules\alliance\Module;
/**
 * Created by PhpStorm.
 * User: user
 * Date: 4/29/16
 * Time: 11:06 PM
 */

?>


<?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($commentModel); ?>

    <?= $form->field($commentModel, 'comment_text', ['template'=>'<div class="input-group"><span class="input-group-addon"> ' . FA::icon('comment') . ' </span>{input}</div>{error}'])->textarea(['rows' => 6, 'placeholder' => $commentModel->getAttributeLabel('comment_text')]) ?>

    <div class="form-group" style="text-align: right;">
        <?= Html::submitButton(FA::icon('comment') . ' ' . Module::t('module', 'COMMENT'), ['class' => 'btn btn-success']) ?>
    </div>

<?php ActiveForm::end(); ?>
