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

<?= $this->render('@app/modules/skoda/views/layouts/default/_header') ?>


    <div class="container">
    	<?= $this->render('@app/modules/skoda/views/layouts/default/_breadcrumbs') ?>
        <?= $content ?>
    </div>
</div>

<?= $this->render('@app/modules/skoda/views/layouts/default/_scroll_to_top') ?>    
    
<?php echo $this->render('@app/modules/skoda/views/layouts/default/_footer') ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
