<?php
    use app\modules\alliance\Module;
    use rmrevin\yii\fontawesome\FA;
    use yii\bootstrap\Nav;
    

$this->title = Module::t('module', 'NAV_ALLIANCE');
$this->params['breadcrumbs'][] = $this->title;    
?>

<div class="alliance-default-index">
    <p style="text-align: right">
        <?php 
            echo Nav::widget([
                'options' => ['class' => 'nav navbar-right nav-pills'],
                'encodeLabels' => false,
                'items' => array_filter([
                    [
                        'label' => FA::icon('phone') . ' ' . Module::t('module', 'NAV_ALLIANCE_PHONEBOOK'),
                        'url' => '/alliance/phonebook/index',
                    ],
                    [
                        'label' => FA::icon('calendar') . ' ' . Module::t('module', 'NAV_ALLIANCE_DUTY'),
                        'url' => '/alliance/dutygraph/',
                    ],
                ]),
            ]);
        ?>
    </p>  
</div>
