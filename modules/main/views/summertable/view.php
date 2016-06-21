<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\main\models\Summertable */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Summertables'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="summertable-view">

    <p>
        <?php // echo Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php 
            // echo Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            //     'class' => 'btn btn-danger',
            //     'data' => [
            //         'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
            //         'method' => 'post',
            //     ],
            // ]) 
        ?>
    </p>

<?php 
    echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            'model',
            'body_color',
            'discount',
            'discount_percent',
            'price',
            'price_discount',
            'payment',
        ],
    ]) 
?>

<p class="buttonpane">
    <?php echo Html::a(Yii::t('app', '{icon} CLOSE', ['icon' => '<i class="fa fa-remove"></i>']), ['index'], ['class' => 'btn btn-danger bnt-sm']) ?>
</p>

</div>
