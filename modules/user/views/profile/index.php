<?php
 
use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\user\Module;
use rmrevin\yii\fontawesome\FA;
 
/* @var $this yii\web\View */
/* @var $model app\modules\user\models\User */
 
// $this->title = Yii::t('app', 'TITLE_PROFILE');
$this->title = Module::t('module', 'PROFILE_TITLE_PROFILE');
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- <div class="user-profile col-lg-6 col-lg-offset-3"> -->
<div>

<?php

// var_dump(Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId()));

    // if(Yii::$app->user->can('updateCreditcalendarPost')) {
    //     echo 'chiefcredit';
    // }
    // else {
    //     echo 'not chiefcredit';
    // }

    // Yii::$app->user->getId()

    // echo '<br/>';

    if(Yii::$app->user->can('deleteCreditcalendarPost')) {
        echo 'viewCreditcalendarOwnPost';
    }
    else {
        echo 'not viewCreditcalendarOwnPost';
    }



    // echo Yii::$app->user->getId();

    // if (Yii::$app->user->can('root')) {
    //     echo 'Hello, root!';
    // }
    // elseif (Yii::$app->user->can('admin')) {
    //     echo 'Hello, admin!';
    // }
    // elseif (Yii::$app->user->can('skassistant')) {
    //     echo 'Hello, skassistant!';
    // }
    // elseif (Yii::$app->user->can('skmastercons')) {
    //     echo 'Hello, skmastercons!';
    // }
    // elseif (Yii::$app->user->can('skservicehead')) {
    //     echo 'Hello, skservicehead!';
    // }
    // elseif (Yii::$app->user->can('skdirector')) {
    //     echo 'Hello, skdirector!';
    // }
    // elseif (Yii::$app->user->can('creditmanager')) {
    //     echo 'Hello, creditmanager!';
    // }
    // elseif (Yii::$app->user->can('chiefcredit')) {
    //     echo 'Hello, chiefcredit!';
    // }
    // echo '<br/>';
    // echo date('d/m/Y H:i:s');
//$table = Yii::$app->db->schema->getTableSchema('all_positions1');
//if (!isset($table->columns['somecolumn'])) {
//    // do something
//}
//print_r($table);

?>    
    
    <h1>
    <?php 
    // Html::encode($this->title)
    ?>
    </h1>
    
    <p style="text-align: right;">
        <?= Html::a(FA::icon('edit') . ' ' . Module::t('module', 'PROFILE_BUTTON_UPDATE'), ['update'], ['class' => 'btn btn-success btn-sm']) ?>
        <?= Html::a(FA::icon('refresh') . ' ' . Module::t('module', 'PROFILE_LINK_PASSWORD_CHANGE'), ['password-change'], ['class' => 'btn btn-danger btn-sm']) ?>
    </p>

    <h1><?= Html::img($model->getImageUrl(),['height' => '80', 'class'=>'img-rounded']) . ' &nbsp; ' .  $model->getAllname(); ?></h1>
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'username',
            'position',
            'role',
            'email',
            'company',
            'created_at:datetime'
        ],
    ]) ?>
 
</div>