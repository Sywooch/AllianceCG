<?php

    use yii\widgets\ListView;
    use app\modules\skoda\Module;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    $this->title = Module::t('module', 'SERVICESHEDULER_INDEX');
    $this->params['breadcrumbs'][] = ['label' => Module::t('module', 'NAV_SKODA'), 'url' => ['/skoda']];
    $this->params['breadcrumbs'][] = $this->title;
?>
  
    <?= $this->render('_submenu', [
        'model' => $dataProvider,
    ]) ?>

<br/>
<br/>

<?= 
    ListView::widget([
        'dataProvider' => $dataProvider,
        'options' => [
            'tag' => 'div',
            'class' => 'list-wrapper',
            'id' => 'list-wrapper',
        ],
        'layout' => "{summary}\n{items}\n{pager}",
        'itemView' => '_listitem',
    ]); 
?>