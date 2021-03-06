<?php

use yii\widgets\Pjax;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
// use kartik\date\DatePicker;
use yii\jui\DatePicker;
use app\modules\alliance\models\Creditcalendar;

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

<div class="creditcalendar-index" id="creditcalendar-index"> <!-- pageDiv -->

            <?= $this->render('_menu', [
                'model' => $model,
            ]) ?>

            <p class="buttonpane">
                <?= Html::a(Yii::t('app', '{icon} CREATE', ['icon' => '<i class="fa fa-plus"></i>']), ['create'], ['class' => 'btn btn-link animlink']) ?>
                <?= Html::a(Yii::t('app', '{icon} REFRESH', ['icon' => '<i class="fa fa-refresh"></i>']), ['calendar'], ['class' => 'btn btn-link animlink']) ?>
                <button class='btn btn-link animlink' onclick="printPage()">
                  <?php echo Yii::t('app', '{icon} PRINT', ['icon' => '<i class="fa fa-print"></i>']) ?>
                </button>
            </p>

            <?php  Pjax::begin(['id' => 'creditCalendar']); ?>
                <?php 
                   $this->registerCssFile('@web/css/calendars/calendars.css', ['depends' => ['app\assets\AppAsset']]);    
                   $this->registerCssFile('@web/css/bootstrap-multiselect.css', ['depends' => ['app\assets\AppAsset']]);  
                   $this->registerCssFile('@web/js/jquery-ui-1.11.4/jquery-ui.css', ['depends' => ['app\assets\AppAsset']]);    
                   $this->registerJsFile(Yii::getAlias('@web/js/jqfc/lib/jquery.min.js'), ['depends' => [
                       'yii\web\YiiAsset',
                       'yii\bootstrap\BootstrapAsset'],
                   ]);           
                   $this->registerJsFile(Yii::getAlias('@web/js/jquery-ui-1.11.4/jquery-ui.min.js'), ['depends' => [
                       'yii\web\YiiAsset',
                       'yii\bootstrap\BootstrapAsset'],
                   ]);    
                   $this->registerJsFile(Yii::getAlias('@web/js/libs/bootstrap-multiselect.js'), ['depends' => [
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

  <div class="panel panel-default"> <!-- panelStart -->
    <div class="panel-heading"><!-- panelHeaderBegin -->

            <form id="creditcalendarfilter">

                  <div class = "input-group authorinput">
                    <span class = "input-group-addon">
                      <label for="datepicker">
                        <i class="fa fa-book"></i>
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

                <?php
                  // echo DatePicker::widget([
                  //     'name'  => 'dateFilter',
                  //     'language' => 'ru',
                  //     'dateFormat' => 'yyyy-MM-dd',
                  //     'clientOptions' => [
                  //       'onSelect' => new \yii\web\JsExpression('function(dateText,inst){
                  //           var d = new Date(dateText);

                  //           if (confirm("Перейти к выбранной дате - " + d.toLocaleDateString("en-GB") + " ?")) {
                  //                   $("#credit_calendar").fullCalendar("changeView", "agendaDay");
                  //                   $("#credit_calendar").fullCalendar("gotoDate", d);
                  //           }
                  //       }'),
                  //     ],
                  // ]);
                ?>
                
                  <div class = "input-group statusinput"> <!-- input-group-statusInput -->

                    <span class = "input-group-addon"> <!-- span input-group-addon -->
                      <label for="datepicker"> <!-- labelDatePicker -->
                        <i class="fa fa-check"></i>
                      </label> <!-- labelDatePicker -->
                    </span> <!-- span input-group-addon -->

                    <select class="form-control" id="status_selector" style="width: 150px; display: initial;"> <!-- selectStatus -->
                      <option value="all">
                        <!-- Любой статус -->
                        <?php echo Yii::t('app', 'CREDITCALENADR_STATUS'); ?>
                      </a>
                      <option value=0>
                        В работе
                      </a>
                      <option value=1>
                        Уточнение
                      </a>
                      <option value=2>
                        Завершено
                      </a>
                    </select> <!-- selectStatus -->
                </div> <!-- input-group-statusInput -->


                  <div class = "input-group statusinput"> <!-- input-group-statusInput -->

                    <span class = "input-group-addon"> <!-- span input-group-addon -->
                      <label for="datepicker"> <!-- labelDatePicker -->
                        <i class="fa fa-check"></i>
                      </label> <!-- labelDatePicker -->
                    </span> <!-- span input-group-addon -->

                    <select class="form-control" id="priority_selector" style="width: 150px; display: initial;"> <!-- selectStatus -->
                      <option value="all">
                        <!-- Приоритет -->
                        <?php echo Yii::t('app', 'CREDITCALENDAR_PRIORITY'); ?>
                      </a>
                      <option value=0>
                        Обычный
                      </a>
                      <option value=1>
                        Высокий
                      </a>
                      <option value=2>
                        Низкий
                      </a>
                    </select> <!-- selectStatus -->
                </div> <!-- input-group-statusInput -->                

            </form>   

    </div> <!-- panelHeadingEnd -->  
      <div class="panel-body"><!-- panelBodyBegin -->
        <div id='credit_calendar'> <!-- calendarBegin -->
        </div> <!-- calendarEnd -->
    </div><!-- panelBodyEnd -->
  </div><!-- panelEnd -->
</div> <!-- pageDivEnd -->

<?php  Pjax::end(); ?>
    