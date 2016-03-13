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

    <table style="margin-bottom: 30px;">
      <tr>
        <th colspan="2"><h1><span class="glyphicon glyphicon-user" style='padding-right:10px;'></span><?= $model->getAllname(); ?></h1></th>
      </tr>
      <tr>
        <td><?= Module::t('module', 'PROFILE_WHERE_USER_CREATED') ?></td>
        <td><?= Yii::$app->formatter->asDate($model->created_at, 'dd/MM/yyyy');  ?></td>
        <!--<td>-->
            <?php
                // Yii::t('app', 'ADMIN_WHERE_USER_UPDATED')
            ?>
        <!--</td>-->
        <!--<td>-->
            <?php 
                // Yii::$app->formatter->asDate($model->updated_at, 'dd/MM/yyyy')
            ?>
        <!--</td>-->
      </tr>
    </table>
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'username',
            'position',
            'email',
        ],
    ]) ?>
 
</div>