<?php
    $this->title = Yii::t('app', 'NAV_ALLIANCE');
    $this->params['breadcrumbs'][] = $this->title;    
?>

    <?= $this->render('_creditDepartment', [
        'model' => $model,
    ]) ?>
