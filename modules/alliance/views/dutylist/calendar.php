<?php

use yii\bootstrap\Tabs;

$this->title = Yii::t('app', 'Dutylists');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'NAV_ALLIANCE'), 'url' => ['/alliance']];
$this->params['breadcrumbs'][] = $this->title;

?>

<?php
    echo Tabs::widget([
        'items' => [
            [
                'label' => 'Таблица',
                'url' => ['/alliance/dutylist/index'],
                'active' => false
            ],
            [
                'label' => 'Календарь',
                'url' => ['/alliance/dutylist/calendar'],
                'active' => true
            ],
        ]
    ]);
?>