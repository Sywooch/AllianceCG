<?php
 
use yii\helpers\Html;
use app\modules\admin\Module;
 
/* @var $this yii\web\View */
/* @var $model \app\modules\user\models\User */
 
$this->title = Module::t('module', 'ADMIN');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-default-index center-block">
    <h1><?= Html::encode($this->title) ?></h1>
 
    <p>
        <?= Html::a('<span class="glyphicon glyphicon-user"></span>  ' . Module::t('module', 'ADMIN_USERS'), ['users/index'], ['class' => 'btn btn-primary']) ?>
        
        <?= Html::a('<span class="glyphicon glyphicon-briefcase"></span>  ' . Module::t('module', 'ADMIN_POSITIONS'), ['positions/index'], ['class' => 'btn btn-primary']) ?>
        
        <?= Html::a('<span class="glyphicon glyphicon-tent"></span>  ' . Module::t('module', 'ADMIN_COMPANIES'), ['companies/index'], ['class' => 'btn btn-primary']) ?>
    </p>    
    
</div>