<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
//use yii\widgets\ActiveForm;
use yii\widgets\ListView;   
use rmrevin\yii\fontawesome\FA;
use app\modules\alliance\Module;
//use yii\helpers\Url;
use yii\widgets\Pjax;
use app\modules\alliance\models\CreditcalendarResponsibles;
//use app\modules\admin\models\User;
//use yii\data\ActiveDataProvider;


/* @var $this yii\web\View */
/* @var $model app\modules\alliance\models\Creditcalendar */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'NAV_ALLIANCE'), 'url' => ['/alliance']];
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'ALLIANCE_CREDITCALENDAR'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>



    <?php
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'description',
            'created_at',
            'updated_at',
        ],
    ]) 
    ?>

<?php 

    $submodel = CreditcalendarResponsibles::find()
        ->where(['calendar_id' => $model->id])
        ->all();
        foreach ($submodel as $value) {
            echo $value->responsible_id;
        }

?>
  
    <?= $this->render('_submenu', [
        'model' => $model,
    ]) ?>

<div class="creditcalendar-view">

    <p style="text-align: right">
        <?= Html::a(FA::icon('edit') . ' ' . Module::t('module', 'CREDITCALENDAR_UPDATE'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm']) ?>
        <?= Html::a(FA::icon('remove') . ' ' . Module::t('module', 'CREDITCALENDAR_DELETE'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger btn-sm',
            'data' => [
                'confirm' => Module::t('module', 'CREDITCALENDAR_CONFIRM_DELETE'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

<div class="panel panel-default">
   
    <div class="panel-heading panel-info">
        <?= $model->getIsTaskIcon() . ' ' . $model->getDisplayUser() . ', ' . $model->location . ', ' . \Yii::t('app', '{0, date}', $model->created_at); ?>
    </div>
    <div class="panel-body">
        
        <h3>
            <?= Html::encode($this->title) ?>
        </h3>
        <div>
            <?= $model->description; ?>            
        </div>
        <div>
            <?= $model->getResponsibles(); ?>            
        </div>
    </div>
</div>

<?php Pjax::begin(['id' => 'comments']) ?>    
    
<?php 
    $listSummary = '<blockquote class="alert-info">' . FA::icon('comments') . ' ' . Module::t('module', 'CREDITCALENDAR_COMMENTS') . ': {totalCount}</blockquote>'; 
    $emptyText = '<blockquote class="alert-success">' . FA::icon('comments') . ' ' . Module::t('module', 'CREDITCALENDAR_COMMENTS_EMPTY') . '</blockquote>'; 
?>
    
<?= 
    ListView::widget([
        'dataProvider' => $listDataProvider,
        'summary' => $listSummary,
        'emptyText' => $emptyText,
        'options' => [
            'tag' => 'div',
            'class' => 'list-wrapper',
            'id' => 'list-wrapper',
        ],
        'layout' => "{summary}\n{items}\n{pager}",
        'itemView' => '_commentsitem',
        'itemOptions' => [
            'tag' => false,
        ],
        'pager' => [
            'firstPageLabel' => 'first',
            'lastPageLabel' => 'last',
            'nextPageLabel' => 'next',
            'prevPageLabel' => 'previous',
            'maxButtonCount' => 3,
        ],
    ]); 
?>
    
<?php Pjax::end() ?>
  
    <?= $this->render('_commentForm', [
        'model' => $model,
    ]) ?>    
    

</div>