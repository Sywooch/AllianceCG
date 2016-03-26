<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\skoda\Module;
use app\modules\admin\models\User;
// use app\modules\user\models\User as UserName;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\modules\skoda\models\Servicesheduler */
/* @var $form yii\widgets\ActiveForm */
?>

<div>

    <?php $form = ActiveForm::begin(
        [
            // 'action' => '/action',
            'method'=>'get',
            'options' => [
                'id' => 'Skoda_calendar',
             ]
        ]); 
    ?>

    <h1><span class="glyphicon glyphicon-piggy-bank" style='padding-right:10px;'></span><?= $model->isNewRecord ? Module::t('module', 'STATUS_CREATE') : Module::t('module', 'STATUS_UPDATE_RN') . ' ' . $model->date; ?></h1>

    <div class="form-group" style="text-align: right">
        <?= Html::submitButton($model->isNewRecord ? '<span class="glyphicon glyphicon-floppy-saved"></span>  ' . Module::t('module', 'STATUS_CREATE') : '<span class="glyphicon glyphicon-pencil"></span>  ' . Module::t('module', 'STATUS_UPDATE'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-floppy-remove"></span>  ' . Module::t('module', 'BUTTON_CANCEL'), ['/skoda/servicesheduler/calendar'], ['class' => 'btn btn-danger']) ?>
    </div>    

    <script type="text/javascript">
        // servicesheduler-date
        $(function(){
            document.getElementById("servicesheduler-date").value = "<?= $_GET['date']; ?>";
            // alert("<?= $_GET['date']; ?>");            
        })
    </script>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model,'date', ['template' => '{input}{error}'])->widget(DatePicker::className(),['options' => ['class' => 'form-control', 'placeholder' => $model->getAttributeLabel( 'date' )]]) ?>

    <?php
        echo '<br/>';

        $mc = User::findAll([
                'position' => 'Мастер-консультант',
                ]            
            );

        foreach ($mc as $key => $value) {
            $mcname = $value->name . ' ' . $value->surname;
            $value->allname = $mcname;
        }
    
        $items = ArrayHelper::map($mc,'allname','allname');
        $params = [
            'prompt' => '-- ' . $model->getAttributeLabel( 'responsible' ) . ' --',
            'inline' => false,
        ];

        echo $form->field($model, 'responsible', ['template'=>' {input}{error}'])->dropDownList($items,$params,['class' => 'form-control input-sm radio', 'itemOptions' => ['class' => 'radio']])
    ?> 

    <?php ActiveForm::end(); ?>
    
</div>
<!-- </div> -->