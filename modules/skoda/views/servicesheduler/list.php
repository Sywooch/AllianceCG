<?php

    use yii\widgets\ListView;
    use app\modules\skoda\Module;
    use yii\helpers\Html;
    use rmrevin\yii\fontawesome\FA;

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

    <p style="text-align: right">

        <?= Html::a(FA::icon('plus') . ' ' . Module::t('module', 'STATUS_CREATE'), ['create'], ['class' => 'btn btn-success btn-sm', 'id' => 'refreshButton']) ?>

        <?= Html::a(FA::icon('refresh') . ' ' . Module::t('module', 'STATUS_REFRESH'), [''], ['class' => 'btn btn-primary btn-sm', 'id' => 'refreshButton']) ?>

    </p>
    
    <?= $this->render('_search', ['model' => $model]); ?>

<br/>
    <?php Yii::$app->user->identity->userfullname; ?>
<br/>

<?= ListView::widget([
        'dataProvider' => $dataProvider,
        'options' => [
            'tag' => 'ul',
            'class' => 'list-wrapper col-lg-12',
            'id' => 'list-wrapper',
        ],
        'layout' => "{summary}\n{items}\n{pager}",
        'summary' => false,
        'pager' => false,
        'itemView' => '_listitem',
        'itemOptions' => [
            'tag' => 'ul',
//            'class' => $model->date < Yii::$app->formatter->asDate('now', 'yyyy-MM-dd') ? $successclass : $dangerclass
            'class' => $model->getListviewcssclass(),
        ],
    ]); 
?>


<script>
    $(document).ready(function(){
        var worker_today = "<?php echo $model->workerevent()?>";
        top.alert(worker_today);
    });
</script>