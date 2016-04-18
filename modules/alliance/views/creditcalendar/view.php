<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ListView;   
use rmrevin\yii\fontawesome\FA;
use app\modules\alliance\Module;

/* @var $this yii\web\View */
/* @var $model app\modules\alliance\models\Creditcalendar */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'NAV_ALLIANCE'), 'url' => ['/alliance']];
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'ALLIANCE_CREDITCALENDAR'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
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
        <?= $model->getIsTaskIcon() . ' ' . $model->author . '' . $model->getTaskresponsible() . ', ' . $model->location . ', ' . \Yii::t('app', '{0, date}', $model->created_at); ?>
    </div>
    <div class="panel-body">
        <!--<blockquote class="alert-info">-->
        <h3>
            <?= Html::encode($this->title) ?>
        </h3>
        <!--</blockquote>-->
        
        <?= $model->description; ?>
        
    </div>
</div>    

<?php $listSummary = '<blockquote class="alert-info">' . FA::icon('comments') . ' ' . Module::t('module', 'CREDITCALENDAR_COMMENTS') . ': {totalCount}</blockquote>'; ?>
    
<?= 
    ListView::widget([
        'dataProvider' => $listDataProvider,
        'summary' => $listSummary,
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

<?php
//    DetailView::widget([
//        'model' => $model,
//        'attributes' => [
//            'id',
//            'title',
//            'date_from',
//            'time_from',
//            'date_to',
//            'time_to',
//            'description:ntext',
//            'location',
//            'is_task',
//            'is_repeat',
//            'author',
//            'created_at',
//        ],
//    ]) 
?>        
        

</div>
