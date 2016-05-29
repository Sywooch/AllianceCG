<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use app\modules\references\models\Employees;

/* @var $this yii\web\View */
/* @var $model app\modules\references\models\Companies */

$this->title = $model->company_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'REFERENCES'), 'url' => ['/references']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'COMPANIES'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- <div class="companies-view col-lg-5 col-lg-offset-3"> -->
<!-- <div class="companies-view col-lg-10 col-lg-offset-1"> -->

    <!--<h1>-->
        <?php // $model->getLogoName(); ?>
    <!--</h1>-->
    
    <p style="text-align: right;">
        <?= Html::a(Yii::t('app', '{icon} COMPANIES', ['icon' => '<i class="fa fa-list"></i>']), ['index'], ['class' => 'btn btn-link']) ?>
        <?= Html::a(Yii::t('app', '{icon} CREATE', ['icon' => '<i class="fa fa-plus"></i>']), ['create'], ['class' => 'btn btn-link']) ?>
        <?= Html::a(Yii::t('app', '{icon} UPDATE', ['icon' => '<i class="fa fa-edit"></i>']), ['update', 'id' => $model->id], ['class' => 'btn btn-link']) ?>
        <?php  
          // Html::a(Yii::t('app', '{icon} ADMIN_COMPANIES_DELETE', ['icon' => FA::icon('')]), ['delete', 'id' => $model->id], [
          //     'class' => 'btn btn-danger btn-sm',
          //     'data' => [
          //         'confirm' => Yii::t('app', 'ADMIN_COMPANY_DELETE_CONFIRM'),
          //         'method' => 'post',
          //     ],
          // ]) 
        ?>        
    </p>    
<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'company_name',
        // 'company_brand',
        // [
        //   'attribute' => 'brands',
        //   'value' => (isset($model->brands->brand) && !empty($model->brands->brand)) ? $model->brands->brand : false,
        // ],
        [
            'attribute' => 'brands',
            // 'value' => $model->companies->company_name,
            'format'=>'raw',
            // 'value'=>Html::a($model->companies->company_name, ['/references/companies/view', 'id' => $model->companies->id]),
            'value' => $model->getBrandlink(),
            'visible' => !empty($model->brands->brand) ? true : false,
        ],
        [
          'attribute' => 'brandlogo',
          // 'value' => (isset($model->brands->brand) && !empty($model->brands->brand)) ? '/' . $model->brands->brand_logo : false,
          'value' => $model->getCompanybrandlogo(),
          'format' => ['image',['width'=>'50','height'=>'50']],
        ],
        [
          'attribute' => 'company_description',
          'format' => 'raw',
        ],
        [
          'attribute' => 'created_at',
          'format' => 'datetime',
        ],
        [
          'attribute' => 'updated_at',
          'format' => 'datetime',
        ],
        [
          'attribute' => 'authorname',
          'value' => $model->authorname->full_name,
        ],
    ],
]); 

?>


<div class="col-sm-9">
    <?= '<h3>' . Yii::t('app', 'EMPLOYEES_THIS_COMPANY') . '</h3>' ?>
</div>
<div class="col-sm-3">
        <?= Html::a(Yii::t('app', '{icon} CREATE_EMPLOYEES', ['icon' => '<i class="fa fa-edit"></i>']), ['/references/employees/create'], [
                'class' => 'plus btn-link',
            ]) ?>
</div>

<?php

    $query = $model->getEmployees();
    $query->where(['state' => Employees::STATUS_ACTIVE]);

    echo GridView::widget([
          'dataProvider' => new ActiveDataProvider(['query' => $query]),
          'showOnEmpty' => true,
          'summary' => false,
          'tableOptions' =>[
              'class' => 'table table-striped table-bordered creditcalendargridview'
          ],
          'columns' => [
              [
                  'header' => '№',
                  'class' => 'yii\grid\SerialColumn'
              ],
              [
                  'attribute' => 'fullName',
                  'value' => 'fullName',
              ],
          ],
      ]); 

?>

<!-- </div> -->
