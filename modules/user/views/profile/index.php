<?php
 
use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\user\Module;
 
/* @var $this yii\web\View */
/* @var $model app\modules\user\models\User */
 
// $this->title = Yii::t('app', 'TITLE_PROFILE');
$this->title = Module::t('module', 'PROFILE_TITLE_PROFILE');
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- <div class="user-profile col-lg-6 col-lg-offset-3"> -->
<div>
 
    <h1>
    <?php 
    // Html::encode($this->title)
    ?>
    </h1>
    
    <p style="text-align: right;">
        <?= Html::a('<span class="glyphicon glyphicon-pencil"></span>  ' . Module::t('module', 'PROFILE_BUTTON_UPDATE'), ['update'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-refresh"></span>  ' . Module::t('module', 'PROFILE_LINK_PASSWORD_CHANGE'), ['password-change'], ['class' => 'btn btn-danger']) ?>
    </p>

    <h1><?= Html::img($model->getImageUrl(),['height' => '80', 'class'=>'img-rounded']) . ' &nbsp; ' .  $model->getAllname(); ?></h1>
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'username',
            'position',
            'email',
            'company',
            'created_at:datetime'
        ],
    ]) ?>
 
</div>