<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\references\Module;
use rmrevin\yii\fontawesome\FA;
use yii\grid\GridView;
use app\components\grid\LinkColumn;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\modules\references\models\Brands */

$this->title = $model->brand;
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'REFERENCES'), 'url' => ['references']];
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'BRANDS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="brands-view">

    <!-- <h1> -->
        <?php // Html::encode($this->title) ?>
    <!-- </h1> -->

    <p style="text-align: right">
        <?= Html::a(FA::icon('list') . ' ' . Module::t('module', 'BRANDS'), ['index'], ['class' => 'btn btn-warning btn-sm']) ?>
        <?= Html::a(FA::icon('plus') . ' ' . Module::t('module', 'CREATE'), ['create'], ['class' => 'btn btn-success btn-sm']) ?>
        <?= Html::a(FA::icon('edit') . ' ' . Module::t('module', 'UPDATE'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm']) ?>
        <?php 
            // echo Html::a(FA::icon('edit') . ' ' . Module::t('module', 'DELETE'), ['delete', 'id' => $model->id], [
            //     'class' => 'btn btn-danger btn-sm',
            //     'data' => [
            //         'confirm' => Module::t('module', 'CONFIRM_DELETE'),
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
                'visible' => !empty($model->companies->company_name) ? true : false,
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

<p style="text-align: right">
        <?= Html::a(FA::icon('edit') . ' ' . Module::t('module', 'CREATE_MODEL'), ['/references/models/create?id=' . $model->id], [
                'class' => 'plus btn-success btn-sm',
            ]) ?>
</p>
<?php
    echo GridView::widget([
        'dataProvider' => new ActiveDataProvider(['query' => $model->getModels()]),
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
                // 'value' => 'fullmodelname',
                'value' => function ($data) {
                    return Html::a($data->fullmodelname, Url::to(['/references/models/view', 'id' => $data->id]));
                },
                'format' => 'raw',
            ],
        ],
    ]);

?>

<p style="text-align: right">
        <?= Html::a(FA::icon('edit') . ' ' . Module::t('module', 'CREATE_EMPLOYEES'), ['/references/employees/create?id=' . $model->id], [
                'class' => 'plus btn-success btn-sm',
            ]) ?>
</p>

<?php

    echo GridView::widget([
        'dataProvider' => new ActiveDataProvider(['query' => $model->getEmployees()]),
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
