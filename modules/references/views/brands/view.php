<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use app\components\grid\LinkColumn;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use app\modules\references\models\Employees;
use app\modules\references\models\Models;

/* @var $this yii\web\View */
/* @var $model app\modules\references\models\Brands */

$this->title = $model->brand;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'REFERENCES'), 'url' => ['references']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'BRANDS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="brands-view">

    <!-- <h1> -->
        <?php // Html::encode($this->title) ?>
    <!-- </h1> -->

    <p style="text-align: right">
        <?= Html::a(Yii::t('app', '{icon} BRANDS', ['icon' => '<i class="fa fa-list"></i>']), ['index'], ['class' => 'btn btn-link animlink']) ?>
        <?= Html::a(Yii::t('app', '{icon} CREATE', ['icon' => '<i class="fa fa-plus"></i>']), ['create'], ['class' => 'btn btn-link animlink']) ?>
        <?= Html::a(Yii::t('app', '{icon} UPDATE', ['icon' => '<i class="fa fa-edit"></i>']), ['update', 'id' => $model->id], ['class' => 'btn btn-link animlink']) ?>
        <?php 
            // echo Html::a(FA::icon('edit') . ' ' . Yii::t('app', 'DELETE'), ['delete', 'id' => $model->id], [
            //     'class' => 'btn btn-link',
            //     'data' => [
            //         'confirm' => Yii::t('app', 'CONFIRM_DELETE'),
            //         'method' => 'post',
            //     ],
            // ]) 
        ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            'brand',
            // 'state',
            [
                'attribute' => 'brand_logo',
                'value' => $model->getImageUrl(),
                'format' => ['image',['width'=>'50']],
                // 'visible' => !empty($model->companies->company_name) ? true : false,
            ],
            [
                'attribute' => 'companies',
                // 'value' => $model->companies->company_name,
                'format'=>'raw',
                // 'value'=>Html::a($model->companies->company_name, ['/references/companies/view', 'id' => $model->companies->id]),
                'value' => $model->getCompanylink(),
                'visible' => !empty($model->companies->company_name) ? true : false,
            ],
            [
                'attribute' => 'state',
                'value' => $model->getStatesName(),
            ],
            [
                'attribute' => 'created_at',
                'format' => 'datetime',
            ],
            [
                'attribute' => 'updated_at',
                'format' => 'datetime',
                'visible' => $model->created_at != $model->updated_at ? true : false,
            ],
            [
                'attribute' => 'author',
                'value' => $model->authorname->full_name,
            ],
        ],
    ]) ?>

</div>

<div class="col-sm-9">
    <?= '<h3>' . Yii::t('app', 'MODELS_THIS_BRAND') . '</h3>' ?>
</div>
<div class="col-sm-3">
        <?= Html::a(Yii::t('app', '{icon} CREATE_MODEL', ['icon' => '<i class="fa fa-edit"></i>']), ['/references/models/create?id=' . $model->id], [
                'class' => 'btn btn-link animlink',
            ]) ?>
</div>

<?php

    $query = $model->getModels();
    $query->where(['state' => Models::STATUS_ACTIVE]);

    echo GridView::widget([
        'dataProvider' => new ActiveDataProvider(['query' => $query]),
        'showOnEmpty' => true,
        'emptyText' => 'Записи отсутствуют',
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
                'attribute' => 'fullmodelname',
                'value' => function ($data) {
                    return Html::a($data->fullmodelname, Url::to(['/references/models/view', 'id' => $data->id]));
                },
                'format' => 'raw',
            ],
        ],
    ]);

?>


<div class="col-sm-9">
    <?= '<h3>' . Yii::t('app', 'EMPLOYEES_THIS_BRAND') . '</h3>' ?>
</div>
<div class="col-sm-3">
        <?= Html::a(Yii::t('app', '{icon} CREATE_EMPLOYEES', ['icon' => '<i class="fa fa-edit"></i>']), ['/references/employees/create?id=' . $model->id], [
                'class' => 'btn btn-link animlink',
            ]) ?>
</div>

<?php

    $query = $model->getEmployees();
    $query->where(['state' => Employees::STATUS_ACTIVE]);


    echo GridView::widget([
        'dataProvider' => new ActiveDataProvider(['query' => $query]),
        'showOnEmpty' => true,
        'emptyText' => 'Записи отсутствуют',
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
                // 'value' => 'fullmodelname',
                'value' => function ($data) {
                    return Html::a($data->fullName, Url::to(['/references/employees/view', 'id' => $data->id]));
                },
                'format' => 'raw',
            ],
        ],
    ]);


?>
