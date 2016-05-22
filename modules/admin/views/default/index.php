<?php
 
use yii\helpers\Html;
use rmrevin\yii\fontawesome\FA;
use yii\bootstrap\Nav;
 
/* @var $this yii\web\View */
/* @var $model \app\modules\user\models\User */
 
$this->title = Yii::t('app', 'ADMIN');
$this->params['breadcrumbs'][] = $this->title;
?>
 
    <p>

        <?php 
            echo Nav::widget([
                'options' => ['class' => 'nav navbar-right nav-pills'],
                'encodeLabels' => false,
                'items' => array_filter([
                    [
                        'label' => Yii::t('app', '{icon} ADMIN_USERS', ['icon' => FA::icon('user')]),
                        'url' => '/admin/users',
                    ],
                    [
                        'label' => Yii::t('app', '{icon} ADMIN_USERROLES', ['icon' => FA::icon('cog')]),
                        'url' => '/admin/userroles',
                    ],
                    [
                        'label' => Yii::t('app', '{icon} ADMIN_TRANSLATIONS', ['icon' => FA::icon('book')]),
                        'url' => '/admin/sourcemessage',
                    ],
                ]),
            ]);
        ?>
    </p>    

<div class="admin-default-index center-block">    
</div>

<?php
    $this->registerJsFile(Yii::getAlias('@web/js/libs/highcharts/highcharts.js'), ['depends' => [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset'],
    ]); 
    $this->registerJsFile(Yii::getAlias('@web/js/modules/admin/default/defaultPageGraph.js'), ['depends' => [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset'],
    ]);         
?>

<div class="col-lg-12" id="admin"></div>