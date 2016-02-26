<?php


/* @var $this \yii\web\View */
/* @var $content string */
use app\components\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        // 'brandLabel' => 'My Company',
        // 'brandLabel' => '<img src="img/logo/fsrar_orig.png" height="36" width="36" class="pull-left"/>FSRAR_LOGO',
        'brandLabel' => Html::img('@web/img/logo/logo.png', ['width'=>'48','height'=>'48']),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            // 'class' => 'navbar-inverse navbar-fixed-top',
        'class' => 'navbar navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'encodeLabels' => false,
        'items' => array_filter([
            ['label' => '<span class="glyphicon glyphicon-home"></span> ' . Yii::t('app', 'NAV_HOME'), 'url' => ['/main/default/index']],
            // ['label' => Yii::t('app', 'NAV_CONTACT'), 'url' => ['/main/contact/index']],
            // ['label' => '<span class="glyphicon glyphicon-envelope"></span>  ' . Yii::t('app', 'NAV_CONTACT'), 'url' => ['/main/contact/index']],
        // Yii::$app->user->isGuest ?
        //     ['label' => '<span class="glyphicon glyphicon-send"></span> ' . Yii::t('app', 'NAV_SIGNUP'), 'url' => ['/user/default/signup']] :
        //     false,
        Yii::$app->user->isGuest ?
            ['label' => '<span class="glyphicon glyphicon-user"></span> ' . Yii::t('app', 'NAV_LOGIN'), 'url' => ['/user/default/login']] :
            false,
        !Yii::$app->user->isGuest ?
            ['label' => '<span class="glyphicon glyphicon-wrench"></span> ' . Yii::t('app', 'NAV_STATUS'), 'items' => [
                ['label' => '<span class="glyphicon glyphicon-wrench"></span> ' . Yii::t('app', 'NAV_STATUS'), 'url' => ['/status/default/index']],
                ['label' => '<span class="glyphicon glyphicon-user"></span> ' . Yii::t('app', 'STATUS_MANAGEMENT'), 'url' => ['/status/statusmonitor/index']],
            ]] :
            false,
        !Yii::$app->user->isGuest ?
            ['label' => '<span class="glyphicon glyphicon-wrench"></span> ' . Yii::t('app', 'NAV_ADMIN'), 'items' => [
                ['label' => '<span class="glyphicon glyphicon-wrench"></span> ' . Yii::t('app', 'NAV_ADMIN'), 'url' => ['/admin/default/index']],
                ['label' => '<span class="glyphicon glyphicon-user"></span> ' . Yii::t('app', 'ADMIN_USERS'), 'url' => ['/admin/users/index']],
                ['label' => '<span class="glyphicon glyphicon-briefcase"></span> ' . Yii::t('app', 'ADMIN_POSITIONS'), 'url' => ['/admin/positions/index']],
            ]] :
            false,
        !Yii::$app->user->isGuest ?
            ['label' => '<span class="glyphicon glyphicon-user"></span> ' . Yii::t('app', 'NAV_PROFILE'), 'items' => [
                ['label' => '<span class="glyphicon glyphicon-search"></span> ' . Yii::t('app', 'NAV_PROFILE_VIEW'), 'url' => ['/user/profile']],
                ['label' => '<span class="glyphicon glyphicon-wrench"></span> ' . Yii::t('app', 'NAV_PROFILE_EDIT'), 'url' => ['/user/profile/update']],
                ['label' => '<span class="glyphicon glyphicon-asterisk"></span> ' . Yii::t('app', 'NAV_PROFILE_PASSWORD_RESET'), 'url' => ['/user/profile/password-change']],
                ['label' => '<span class="glyphicon glyphicon-off"></span> ' . Yii::t('app', 'NAV_LOGOUT'), 'url' => ['/user/default/logout'], 'linkOptions' => ['data-method' => 'post']]
            ]] :
            false,
        // !Yii::$app->user->isGuest ?
        //     ['label' => '<span class="glyphicon glyphicon-user"></span> ' . Yii::t('app', 'NAV_PROFILE'), 'url' => ['/user/profile/index']] :
        //     false,
        // !Yii::$app->user->isGuest ?
        //     ['label' => '<span class="glyphicon glyphicon-off"></span> ' . Yii::t('app', 'NAV_LOGOUT'),
        //         'url' => ['/user/default/logout'],
        //         'linkOptions' => ['data-method' => 'post']] :
        //     false,
        ]),
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>  
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left"><b>&copy; <?= Yii::$app->params['org'] . '' ?> <?= date('Y') ?></b></p>

        <p class="pull-right"><?= Html::img('@web/img/logo/logo.png', ['width'=>'36','height'=>'36'])?>  <b><?= Yii::$app->name ?> </b></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
