<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\references\Module;
use rmrevin\yii\fontawesome\FA;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\modules\references\models\Companies */

$this->title = $model->company_name;
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'REFERENCES'), 'url' => ['/references']];
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'COMPANIES'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- <div class="companies-view col-lg-5 col-lg-offset-3"> -->
<div class="companies-view col-lg-10 col-lg-offset-1">

    <!--<h1>-->
        <?php // $model->getLogoName(); ?>
    <!--</h1>-->
    
    <p style="text-align: right;">
        <?= Html::a(FA::icon('list') . ' ' . Module::t('module', 'COMPANIES'), ['index'], ['class' => 'btn btn-warning btn-sm']) ?>
        <?= Html::a(FA::icon('plus') . ' ' . Module::t('module', 'CREATE'), ['create'], ['class' => 'btn btn-success btn-sm']) ?>
        <?= Html::a(FA::icon('edit') . ' ' . Module::t('module', 'UPDATE'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm']) ?>
        <?php  
          // Html::a(FA::icon('remove') . ' ' . Module::t('module', 'ADMIN_COMPANIES_DELETE'), ['delete', 'id' => $model->id], [
          //     'class' => 'btn btn-danger btn-sm',
          //     'data' => [
          //         'confirm' => Module::t('module', 'ADMIN_COMPANY_DELETE_CONFIRM'),
          //         'method' => 'post',
          //     ],
          // ]) 
        ?>        
    </p>    
<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'company_name',
        'company_brand',
         [
             'attribute'=>'company_logo',
             'value'=>$model->getSingleLogo(),
             'format' => ['image',['height'=>'80']],
         ],
        [
            'attribute' => 'company_description',
            'format' => 'raw',
        ],
    ],
]); 

    echo GridView::widget([
          'dataProvider' => new ActiveDataProvider(['query' => $model->getUser()]),
          'showOnEmpty' => true,
          'tableOptions' =>[
              'class' => 'table table-striped table-bordered creditcalendargridview'
          ],
          'columns' => [
              [
                  'header' => '№',
                  'class' => 'yii\grid\SerialColumn'
              ],
              [
                  'attribute' => 'fullname',
                  'value' => 'full_name',
              ],
          ],
      ]); 

?>

</div>
