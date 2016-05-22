<?php


/* @var $this \yii\web\View */
/* @var $content string */
use app\components\widgets\Alert;
use yii\helpers\Url;
use yii\helpers\Html;
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

<?= $this->render('@app/modules/main/views/layouts/skoda/default/_header') ?>


    <div class="container">
        <div class="col-sm-3">
        <?= $this->render('@app/modules/main/views/layouts/_sidebar') ?>
        </div>
        <div class="col-sm-9">  
    	<?= $this->render('@app/modules/main/views/layouts/_breadcrumbs') ?>
        <?= $content ?>
        </div>
    </div>
</div>

<?= $this->render('@app/modules/main/views/layouts/_scroll_to_top') ?>    
    
<?php echo $this->render('@app/modules/main/views/layouts/skoda/default/_footer') ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
