<?php

use yii\bootstrap\Tabs;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use kartik\date\DatePicker;
use yii\bootstrap\Modal;
use app\modules\references\models\Employees;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

$this->title = Yii::t('app', 'Dutylists');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'NAV_ALLIANCE'), 'url' => ['/alliance']];
$this->params['breadcrumbs'][] = $this->title;

$modal = file_get_contents('js/modules/alliance/dutylist/modal.js');
$this->registerJs($modal);

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

<br/>

<div class="buttonpane">

    <?php
         $createButton = Yii::$app->user->can('admin') ? Html::a(Yii::t('app', '{icon} CREATE', ['icon' => '<i class="fa fa-plus"></i>']), '#mymodal', [
                                'class' => 'btn btn-link animlink', 'title' => 'Назначить','data-toggle'=>'modal','data-backdrop'=>false,'data-remote'=>Url::to('/alliance/dutylist/create')
                            ]) : false;
         echo $createButton;    

    ?>

	<?= Html::a(Yii::t('app', '{icon} REFRESH', ['icon' => '<i class="fa fa-refresh"></i>']), ['calendar'], ['class' => 'btn btn-link animlink']) ?>

	<?= Html::a(Yii::t('app', '{icon} CREDITCALENDAR_EXPORT_EXCEL', ['icon' =>'<i class="fa fa-file-excel-o"></i>'] ), ['export'], [
	        'id' => 'Excel',
	        'class' => 'btn btn-link animlink',
	        'onclick' => 'setParams()',
	        'data' => [
	            'method' => 'post',
	            'confirm' => Yii::t('app', 'CREDITCALENDAR_EXPORT_CONFIRM'),
	        ]
	     ]);
	?>

</div>

<?php Pjax::begin(['id' => 'dutylist']); ?> 


                <?php 
                   $this->registerCssFile('@web/css/calendars/calendars.css', ['depends' => ['app\assets\AppAsset']]);    
                   $this->registerCssFile('@web/css/bootstrap-multiselect.css', ['depends' => ['app\assets\AppAsset']]);  
                   $this->registerCssFile('@web/css/checkboxes.css', ['depends' => ['app\assets\AppAsset']]);  
                   $this->registerCssFile('@web/js/jquery-ui-1.11.4/jquery-ui.css', ['depends' => ['app\assets\AppAsset']]); 
                   // $this->registerJsFile('@web/js/libs/jquery.min.js',  ['position' => yii\web\View::POS_END]);   
                   // $this->registerJsFile(Yii::getAlias('@web/js/jqfc/lib/jquery-3.0.0.min.js'), ['depends' => [
                   //     'yii\web\YiiAsset',
                   //     'yii\bootstrap\BootstrapAsset'],
                   // ]);           
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
                   $this->registerJsFile(Yii::getAlias('@web/js/modules/alliance/dutylist/calendar.js'), ['depends' => [
                       'yii\web\YiiAsset',
                       'yii\bootstrap\BootstrapAsset'],
                   ]); 
                   // $this->registerJsFile(Yii::getAlias('@web/js/modules/alliance/creditcalendar/printCalendar.js'), ['depends' => [
                   //     'yii\web\YiiAsset',
                   //     'yii\bootstrap\BootstrapAsset'],
                   // ]);    
               ?>
              <div class="panel panel-default">
                <div class="panel-heading">

                  <div class = "input-group calinput">
                    <span class = "input-group-addon">
                      <label for="datepicker">
                        <i class="fa fa-calendar"></i>
                      </label>
                    </span>
                    <input 
                        class="form-control datepicker datepicker-inline"
                        id="dutylistDatepicker"
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

                   <div class="col-md-3">

                    <?php
                        $allEmployees = array('all' => 'Все');
                        $Employees = Employees::find()
                            ->where(
                                    ['<>', 'state', Employees::STATUS_BLOCKED]
                                )
                            ->andWhere(
                                    ['duty_status' => 1]
                                )
                            ->all()
                            ;
                    
                        foreach ($Employees as $key => $value) {
                            // $dutyName = $value->name . ' ' . $value->surname;
                          $dutyName = $value->surname . ' ' . mb_substr($value->name, 0, 1) . '.' . mb_substr($value->patronimyc, 0, 1) . '.';
                            $value->name = $dutyName;
                        }

                        $employeesList = ArrayHelper::merge($allEmployees, ArrayHelper::map($Employees,'name','name'));

                        // $items = ArrayHelper::map($Employees,'id','name');
                        $items = $employeesList;
                        $params = [
                            // 'prompt' => '-- ' . $model->getAttributeLabel( 'employee_filter' ) . ' --',
                            'id' => 'employee_filter',
                        ];
                        $form = ActiveForm::begin();
                        echo $form->field($model, 'employee_filter', ['template'=>'<div class="input-group"><span class="input-group-addon">  <i class="fa fa-briefcase"></i>  </span>{input}</div>{error}'])->dropDownList($items,$params);
                        ActiveForm::end();
                    ?>
                  </div> 
                  <!-- <div class="col-md-4"> -->
                    <input type="checkbox" class="checkbox" id="checkbox" onchange = 'showOrHide();' />
                    <label for="checkbox">Показать / Скрыть будние дни</label>
                    <!-- <input type='button' value='Change' onClick="hideSideBar()"> -->
                  <!-- </div> -->


                </div>
                <div class="panel-body">
                  <div id="dutylsitCalendar"></div>
                </div>
                <div class="panel-footer">
                  <!-- Panel Footer -->
                </div>
              </div>

                <div id="fullCalModal" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
                                <h4 id="modalTitle" class="modal-title"></h4>
                            </div>
                            <div id="modalBody" class="modal-body"></div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                                <!-- <button class="btn btn-primary"><a id="eventUrl" target="_blank">Event Page</a></button> -->
                            </div>
                        </div>
                    </div>
                </div>               

<?php Pjax::end();?>

<?php \yii\bootstrap\Modal::begin(['header'=>'<h4>График дежурств</h4>', 'id'=>'mymodal'])?>
<?php \yii\bootstrap\Modal::end()?>

        <?php
            Modal::begin([
                    // 'header' => '<h4>Create</h4>',
                    'id' => 'modal',
                    'size' => 'modal-lg',
                ]);
            
            echo "<div id='modalContent'></div>";
            echo "<div id='dutyForm'></div>";

            Modal::end();
        ?>