<?php
	use yii\widgets\Breadcrumbs;
?>

<?= Breadcrumbs::widget([
        'homeLink' => [
            // 'label' => '<span class="glyphicon glyphicon-home"></span>' . ' ' . Yii::t('yii', 'Home'),
            'label' => '<span class="glyphicon glyphicon-home"></span>',
            'url' => Yii::$app->homeUrl,
            'encode' => false// Requested feature
        ],
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]) ?>