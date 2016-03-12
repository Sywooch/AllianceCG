<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\admin\Module;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Companies */

$this->title = $model->company_brand;
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'ADMIN_COMPANIES_TITLE'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="companies-view col-lg-5 col-lg-offset-3">

    <h1>
        <?= $model->getLogoName(); ?>
    </h1>
    
    <p style="text-align: right;">
        <?= Html::a('<span class="glyphicon glyphicon-th-list"></span>  ' . Module::t('module', 'ADMIN_COMPANIES'), ['/admin/companies'], ['class' => 'btn btn-warning']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-edit"></span>  ' . Module::t('module', 'ADMIN_COMPANIES_UPDATE'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-remove"></span>  ' . Module::t('module', 'ADMIN_COMPANIES_DELETE'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Module::t('module', 'ADMIN_COMPANY_DELETE_CONFIRM'),
                'method' => 'post',
            ],
        ]) ?>        
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
    ]) ?>

</div>
