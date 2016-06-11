<?php

use yii\widgets\Pjax;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$this->title = Yii::t('app', 'CREDITCALENDAR');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'NAV_ALLIANCE'), 'url' => ['/alliance']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'CREDITCALENDARS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$toggleSearch = file_get_contents('js/modules/alliance/creditcalendar/toggleSearch.js');
$this->registerJs($toggleSearch, View::POS_END);

$toggleSearch = file_get_contents('js/modules/alliance/creditcalendar/updateCalendar.js');
$this->registerJs($toggleSearch, View::POS_END);

?>

<div class="creditcalendar-index" id="creditcalendar-index">

            <?= $this->render('_menu', [
                'model' => $model,
            ]) ?>

            <p class="buttonpane">
                <?= Html::a(Yii::t('app', '{icon} CREATE', ['icon' => '<i class="fa fa-plus"></i>']), ['create'], ['class' => 'btn btn-link animlink']) ?>
                <?= Html::a(Yii::t('app', '{icon} REFRESH', ['icon' => '<i class="fa fa-refresh"></i>']), ['calendar'], ['class' => 'btn btn-link animlink']) ?>
                <button class='btn btn-link animlink' onclick="printPage()">
                  <?php echo Yii::t('app', '{icon} PRINT', ['icon' => '<i class="fa fa-print"></i>']) ?>
                </button>
                <?php // echo Html::button(Yii::t('app', '{icon} SEARCH', ['icon' => '<i class="fa fa-search"></i>']), ['class' => 'btn-link animlink', 'id' => 'advancedSearch']) ?>
            </p>

            <!-- <div class="bs-callout bs-callout-info" id="creditcalendar-search"> -->
         

            <?php  Pjax::begin(['id' => 'creditCalendar']); ?>
                <?php 
                   $this->registerCssFile('@web/css/calendars/calendars.css', ['depends' => ['app\assets\AppAsset']]);    
                   $this->registerCssFile('@web/js/jquery-ui-1.11.4/jquery-ui.css', ['depends' => ['app\assets\AppAsset']]);    
                   // $this->registerCssFile('@web/js/jquery-ui-1.11.4/jquery-bootstrap-datepicker.css', ['depends' => ['app\assets\AppAsset']]);   
                   $this->registerJsFile(Yii::getAlias('@web/js/jqfc/lib/jquery.min.js'), ['depends' => [
                       'yii\web\YiiAsset',
                       'yii\bootstrap\BootstrapAsset'],
                   ]);           
                   $this->registerJsFile(Yii::getAlias('@web/js/jquery-ui-1.11.4/jquery-ui.min.js'), ['depends' => [
                       'yii\web\YiiAsset',
                       'yii\bootstrap\BootstrapAsset'],
                   ]);          
                   $this->registerJsFile(Yii::getAlias('@web/js/jqfc/lib/moment.min.js'), ['depends' => [
                       'yii\web\YiiAsset',
                       'yii\bootstrap\BootstrapAsset'],
                   ]);
                   $this->registerJsFile(Yii::getAlias('@web/js/jqfc/fullcalendar.js'), ['depends' => [
                       'yii\web\YiiAsset',
                       'yii\bootstrap\BootstrapAsset'],
                   ]);
                   $this->registerJsFile(Yii::getAlias('@web/js/jqfc/lang/ru.js'), ['depends' => [
                       'yii\web\YiiAsset',
                       'yii\bootstrap\BootstrapAsset'],
                   ]);  
                   $this->registerJsFile(Yii::getAlias('@web/js/modules/alliance/creditcalendar/creditcalendar.js'), ['depends' => [
                       'yii\web\YiiAsset',
                       'yii\bootstrap\BootstrapAsset'],
                   ]); 
                   $this->registerJsFile(Yii::getAlias('@web/js/modules/alliance/creditcalendar/printCalendar.js'), ['depends' => [
                       'yii\web\YiiAsset',
                       'yii\bootstrap\BootstrapAsset'],
                   ]);    
               ?>

<br/>

          <!-- <button onclick="printPage()">Print this page</button> -->

<!-- <div class="container">   -->
  <div class="panel panel-default">
    <div class="panel-heading">

            <form id="creditcalendarfilter" class="buttonpane">

                  <div class = "input-group authorinput">
                    <span class = "input-group-addon">
                      <label for="datepicker">
                        <i class="fa fa-ищщл"></i>
                      </label>
                    </span>
                <select class="form-control" id="author_selector" style="width: 150px; display: initial;">
                  <option value="all">
                    Все записи
                  </a>
                  <option value=<?= Yii::$app->user->getId() ?>>
                    Мои записи
                  </a>
                </select>
                </div>

                  <div class = "input-group calinput">
                    <span class = "input-group-addon">
                      <label for="datepicker">
                        <i class="fa fa-calendar"></i>
                      </label>
                    </span>
                    <input 
                        class="form-control datepicker datepicker-inline"
                        id="datepicker"
                        placeholder="Дата: ДД/ММ/ГГГГ"
                        onkeyup="
                            var v = this.value;
                            if (v.match(/^\d{2}$/) !== null) {
                                this.value = v + '/';
                            } else if (v.match(/^\d{2}\/\d{2}$/) !== null) {
                                this.value = v + '/';
                            }"
                        maxlength="10" 
                    >
                    </input> 
                    </div>
                   <!-- <span class = "input-group-btn"> -->
                      <!-- <button class = "btn btn-primary animlinkColor" type = "button"> -->
                         <!-- Go! -->
                      <!-- </button> -->
                   <!-- </span> -->
                  <!-- <button class="btn btn-primary btn-sm animlinkColor" type="button" onclick="creditcalendarfilter.reset()">Очистить</button> -->

            </form>   

    </div>
    <div class="panel-body">
      <div id='credit_calendar'></div> 
    </div>
  </div>
<!-- </div> -->


<!--           <div id="eventContent" title="Event Details" style="display:none;">
              Начало: <span id="startTime"></span><br>
              Окончание: <span id="endTime"></span><br><br>
              <p id="eventInfo"></p>
              <p><strong><a id="eventLink" href="" target="_blank">Перейти на страницу записи</a></strong></p>
          </div>     -->      

          <?php  Pjax::end(); ?>

           <script type="text/javascript">
            var now = new Date();
            var formattedNow = now.toLocaleDateString('en-GB');
            var curUser = '<?php echo Yii::$app->user->identity->full_name;?>';
            self.alert('Текущий пользователь: ' + curUser + '\r\n' + 'Текущая дата: ' + formattedNow);
          </script>
    
</div>