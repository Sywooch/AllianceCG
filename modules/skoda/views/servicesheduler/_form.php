<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\skoda\Module;
use app\modules\admin\models\User;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;
use rmrevin\yii\fontawesome\FA;
use app\modules\references\models\Employees;
use app\modules\skoda\models\Servicesheduler;

/* @var $this yii\web\View */
/* @var $model app\modules\skoda\models\Servicesheduler */
/* @var $form yii\widgets\ActiveForm */
?>

<div>

    <?php $form = ActiveForm::begin(
        [
            'options' => [
                'id' => 'Skoda_calendar',
             ]
        ]); 
    ?>

    <h1><?php $model->isNewRecord ? FA::icon('bed') .' '. Module::t('module', 'STATUS_CREATE') : FA::icon('bed') .' '. Module::t('module', 'STATUS_UPDATE_RN') . ' ' . $model->date; ?></h1>

    <div class="alert alert-danger">
        <?= Module::t('module', 'ADD_SERVICESHEDULER_INFO'); ?>
    </div>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model,'date', ['template' => '{input}{error}'])->widget(DatePicker::className(),['options' => ['class' => 'form-control', 'placeholder' => $model->getAttributeLabel( 'date' )]]) ?>

    <?php

        $responsible = Employees::find()
            ->joinWith(['position', 'brand'])
            ->where([
                    '<>', '{{%employees}}.state', Employees::STATUS_BLOCKED,
                ])
            ->andwhere([
                    '{{%positions}}.position' => Employees::MASTER_CONSULTANT,
                ])
            ->andwhere([
                    '{{%brands}}.brand' => Servicesheduler::CURRENT_BRAND,
                ])
            ->all();   
    
        foreach ($responsible as $key => $value) {
            $mcname = $value->name . ' ' . $value->surname;
            $value->name = $mcname;
        }


        $items = ArrayHelper::map($responsible,'id','name');
        $params = [
            'options' => isset($_GET['id']) ? [$_GET['id'] => ['Selected'=>'selected']] : false,
            'prompt' => '-- ' . $model->getAttributeLabel( 'responsible' ) . ' --',
        ];
        echo $form->field($model, 'responsible', ['template'=>'<div class="input-group"><span class="input-group-addon"> ' . FA::icon('user') . ' </span>{input}</div>{error}'])->dropDownList($items,$params);
    ?> 

    <div class="form-group" style="text-align: right">
        <?= Html::submitButton($model->isNewRecord ? FA::icon('save') . Module::t('module', 'STATUS_CREATE') : FA::icon('edit') . Module::t('module', 'STATUS_UPDATE'), ['class' => $model->isNewRecord ? 'btn btn-success btn-sm' : 'btn btn-primary btn-sm']) ?>
        <?= Html::a(FA::icon('remove') . Module::t('module', 'BUTTON_CANCEL'), ['/skoda/servicesheduler/calendar'], ['class' => 'btn btn-danger btn-sm']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    
</div>