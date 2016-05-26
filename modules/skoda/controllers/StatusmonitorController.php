<?php
 
namespace app\modules\skoda\controllers;

use Yii;
use app\modules\skoda\models\Statusmonitor;
use app\modules\skoda\models\StatusmonitorSearch;
use app\modules\skoda\models\Servicesheduler;
use app\modules\skoda\models\MonitorSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;

/**
 * StatusmonitorController implements the CRUD actions for Statusmonitor model.
 */
class StatusmonitorController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            // 'access' => [
            //     'class' => AccessControl::className(),
            //     'rules' => [
            //         [
            //             'allow' => true,
            //             'actions'=>['error', 'monitor'],
            //             'roles' => ['?'],
            //         ],
            //         [
            //             'allow' => true,
            //             'actions'=>['view', 'create', 'update', 'index', 'monitor', 'dashboard'],
            //             'roles' => ['@'],
            //         ],                  
            //     ],
            // ],            
        ];
    }

    /**
     * Lists all Statusmonitor models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new Statusmonitor();
        $searchModel = new StatusmonitorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }
    
    // public function actionExport(){
    //     $model = StatusmonitorSearch::find()->All();
    //     $filename = 'Statusmonitor-'.Date('Y-m-d-H-i-s').'.xls';
    //     header("Content-type: application/vnd-ms-excel");
    //     header("Content-Disposition: attachment; filename=".$filename);
    //     echo '<table border="1" width="100%">
    //         <thead>
    //             <tr>
    //                 <th>№</th>
    //                 <th>Начало</th>
    //                 <th>Окончание</th>
    //             </tr>
    //         </thead>';
    //         foreach($model as $data){
    //             echo '
    //                 <tr>
    //                     <td>'.$data['regnumber'].'</td>
    //                     <td>'.$data['from'].'</td>
    //                     <td>'.$data['to'].'</td>
    //                 </tr>
    //             ';
    //         }
    //     echo '</table>';

    // }    

    public function actionExport(){
        if (!Yii::$app->user->can('admin')) {
            throw new ForbiddenHttpException(Yii::t('app', 'ONLY_ADMIN_CAN_EXPORT_EXCEL'));
        }
        else {
            $objPHPExcel = new \PHPExcel();         
            
            // № листа
            $sheet=0;
            
            // № строки с которой начинаются табличные данные
            $row=4;

            // № строки заголовка
            $titleNumber=1;   

            $objPHPExcel->setActiveSheetIndex($sheet);
     
            $model = new Statusmonitor();

            // Получить id отмеченных записей (преобразовать полученный массив в строку)
            $keyList = Yii::$app->request->post('keyList');
            $keyListArray = explode(',', $keyList);

            $query = Statusmonitor::find();            
            $query->where(['{{%statusmonitor}}.id' => $keyListArray]);
            $query->joinWith('authorname');
            // Условие выборки - отмеченные записи
            // $query->where(['id' => $keyListArray]);
            $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'pagination' => false,
            ]);
                     
            // Размер листа, ориентация
            $objPHPExcel->getActiveSheet()
                ->getPageSetup()
                ->setOrientation(\PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
            $objPHPExcel->getActiveSheet()
                ->getPageSetup()
                ->setPaperSize(\PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
            
            // Автофильтр
            $objPHPExcel->getActiveSheet()->setAutoFilter('A'.($row-1).':H'.($row-1));

            // Слияние ячеек в заголовке таблицы
            $objPHPExcel->getActiveSheet()->mergeCells('A'.$titleNumber.':H'.$titleNumber);

            // Жирный шрифт в заголовке
            $objPHPExcel->getActiveSheet()->getStyle('A'.($row-1).':H'.($row-1))->getFont()->setBold(true);

            // Жирный шрифт в заголовках колонок
            $objPHPExcel->getActiveSheet()->getStyle('A'.$titleNumber)->getFont()->setBold(true);

            // Заголовки колонок
            $objPHPExcel->getActiveSheet()->setTitle(Yii::t('app','SK_TITLE').date("d-m-Y-H-i"))                
                ->setCellValue('A'.($row-1), $model->getAttributeLabel('regnumber'))
                ->setCellValue('B'.($row-1), $model->getAttributeLabel('from'))
                ->setCellValue('C'.($row-1), $model->getAttributeLabel('to'))
                ->setCellValue('D'.($row-1), $model->getAttributeLabel('worker'))
                ->setCellValue('E'.($row-1), $model->getAttributeLabel('carstatus'))
                ->setCellValue('F'.($row-1), $model->getAttributeLabel('created_at'))
                ->setCellValue('G'.($row-1), $model->getAttributeLabel('updated_at'))
                ->setCellValue('H'.($row-1), $model->getAttributeLabel('author'))
                ;

            // Данные из запроса
            foreach ($dataProvider->models as $exportrows) {
                $objPHPExcel->getActiveSheet()->setCellValue('A'.$row,$exportrows->regnumber); 
                $objPHPExcel->getActiveSheet()->setCellValue('B'.$row,$exportrows->from); 
                $objPHPExcel->getActiveSheet()->setCellValue('C'.$row,$exportrows->to); 
                $objPHPExcel->getActiveSheet()->setCellValue('D'.$row,$exportrows->responsible); 
                $objPHPExcel->getActiveSheet()->setCellValue('E'.$row,$exportrows->getCarWorkStatus()); 
                $objPHPExcel->getActiveSheet()->setCellValue('F'.$row,$exportrows->created_at); 
                $objPHPExcel->getActiveSheet()->setCellValue('G'.$row,$exportrows->updated_at); 
                $objPHPExcel->getActiveSheet()->setCellValue('H'.$row,$exportrows->authorname->fullName); 
                $row++ ;
            }  

            // Excel list header
            $objPHPExcel->getActiveSheet()
                ->getHeaderFooter()
                ->setOddHeader('&R&B'.Yii::t('app', 'REGIONS'));

            // Excel list footer
            $objPHPExcel->getActiveSheet()
                ->getHeaderFooter()->setOddFooter('&R&F Стр. &P / &N');
            $objPHPExcel->getActiveSheet()
                ->getHeaderFooter()->setEvenFooter('&L&F Стр. &P / &N'); 


            // № последней ячейки с данными
            $rowNumber = $objPHPExcel->setActiveSheetIndex()->getHighestRow();  

            // Excel table borders
            $border_thin = [
              'borders' => [
                'allborders' => [
                  'style' => \PHPExcel_Style_Border::BORDER_THIN
                ]
              ]
            ];

            // Текст по центру
            $centered = [
                'alignment' => [
                    'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                ]
            ]; 

            // Цвет ячеек таблицы
            $colors = [
                    'fill' => [
                        'type' => \PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => ['rgb' => 'EDEDED']  // 1E90FF
                    ]
                ];

            // Цвет ячеек заголовков
            $headercolors = [
                    'fill' => [
                        'type' => \PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => ['rgb' => '5cb85c']  // EDEDED
                    ]
                ];

            // Цвет текста
            $fontheadercolors = [
                'font'  => [
                    'bold'  => true,
                    'color' => ['rgb' => 'FFFFFF'],
                    'size'  => 10,
                    'name'  => 'Verdana'
                ]];

            $tablefont = [
                'font'  => [
                    'bold'  => true,
                    'color' => ['rgb' => '000000'],
                    'size'  => 8,
                    'name'  => 'Verdana'
                ]];


            $objPHPExcel->getActiveSheet()->getStyle('A3:H'.($row-1))->applyFromArray($headercolors);
            $objPHPExcel->getActiveSheet()->getStyle('A3:H3')->applyFromArray($fontheadercolors);

            $objPHPExcel->getActiveSheet()->getStyle('A4:H'.($row-1))->applyFromArray($colors);
            $objPHPExcel->getActiveSheet()->getStyle('A4:H'.($row-1))->applyFromArray($tablefont);


            $objPHPExcel->getActiveSheet()->getStyle("A3:H".($rowNumber))->applyFromArray($border_thin);
            unset($styleArray);

            // Ширина колонок таблицы
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(35);
            $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
            $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
            $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
            $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
            // Заголовок по центру
            $objPHPExcel->getActiveSheet()->getStyle('A'.$titleNumber.':H'.$titleNumber)->applyFromArray($centered);

            // Текст заголовка
            $objPHPExcel->getActiveSheet()->setCellValue('A'.$titleNumber, Yii::t('app', 'STATUS_TABLEHEADER') . '_' . date("d.m.Y H:i"));
            // $objPHPExcel->getActiveSheet()->setCellValue('A'.($titleNumber+1), $rowNumber);

            // Тип выгружаемого файла
            // header('Content-Type: application/vnd.ms-excel'); // Excel < 2007
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); // Excel2007

            // Имя выгружаемого файла
            $filename = Yii::t('app','STATUSMONITOR_EXCEL_TITLE') . '_' . date("d-m-Y-H-i-s").".xlsx";

            header('Content-Disposition: attachment;filename='.$filename .' ');
            header('Cache-Control: max-age=0');

            $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007'); // Excel5 для выгрузки с расширением .xls
            $objWriter->save('php://output'); 
        }
    }    

    public function actionCalendar()
    {

        $model = new Statusmonitor();
                
        return $this->render('calendar', [
            'model' => $model,         
            ]);
    }
    
    public function actionCalendarsearch()
    {
        $this->layout = false;
        $model = new StatusmonitorSearch();
        return $this->render('_calendarSearch', [
            'model' => $model,
        ]);
    }

    public function actionMonitor()
    {
        $this->layout = '@app/modules/main/views/layouts/skoda/monitor/main';
        $searchModel = new MonitorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('monitor', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);     
    }    

    /**
     * Displays a single Statusmonitor model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Statusmonitor model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Statusmonitor();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Statusmonitor model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Statusmonitor model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Statusmonitor model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Statusmonitor the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Statusmonitor::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionMultipledelete()
    {
        $pk = Yii::$app->request->post('row_id');
        $val = Statusmonitor::STATUS_BLOCKED;
        Statusmonitor::updateAll(['state' => $val], ['in', 'id', $pk]);

        return $this->redirect(['index']);

    }

    public function actionMultiplerestore()
    {
        $pk = Yii::$app->request->post('row_id');
        $val = Statusmonitor::STATUS_ACTIVE;
        Statusmonitor::updateAll(['state' => $val], ['in', 'id', $pk]);

        return $this->redirect(['index']);

    }   
}
