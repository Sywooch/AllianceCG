<?php

namespace app\modules\alliance\controllers;

use Yii;
use app\modules\alliance\models\Dutylist;
use app\modules\alliance\models\DutylistSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\widgets\ActiveForm;
use yii\data\ActiveDataProvider;

/**
 * DutylistController implements the CRUD actions for Dutylist model.
 */
class DutylistController extends Controller
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
        ];
    }

    /**
     * Lists all Dutylist models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DutylistSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'model' => $searchModel,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionCalendarsearch()
    {
        $this->layout = false;
        $model = new DutylistSearch();
        return $this->render('_calendarSearch', [
            'model' => $model,
        ]);
    }    

    /**
     * Lists all Creditcalendar models.
     * @return mixed
     */
    public function actionCalendar()
    {
        $model = new Dutylist();
        $searchModel = new DutylistSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('calendar', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }   

    /**
     * Displays a single Dutylist model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
        ]);
    }
    
    // public function actionView($id)
    // {
    //     return $this->render('view', [
    //         'model' => $this->findModel($id),
    //     ]);
    // }

    /**
     * Creates a new Dutylist model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Dutylist();

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            // return $this->redirect(['view', 'id' => $model->id]);
            // return $this->redirect('index');
            if($model->save())
            {
                echo 1;
            }
            else
            {
                echo 0;
            }
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }        

        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
        //     return $this->redirect(['view', 'id' => $model->id]);
        // } else {
        //     return $this->render('create', [
        //         'model' => $model,
        //     ]);
        // }
    }

    /**
     * Updates an existing Dutylist model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            // return $this->redirect(['view', 'id' => $model->id]);
            // return $this->redirect('index');
            if($model->save())
            {
                echo 1;
            }
            else
            {
                echo 0;
            }
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
            ]);
        }

        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
        //     return $this->redirect(['view', 'id' => $model->id]);
        // } else {
        //     return $this->render('update', [
        //         'model' => $model,
        //     ]);
        // }
    }

    /**
     * Deletes an existing Dutylist model.
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
     * Finds the Dutylist model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Dutylist the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Dutylist::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    /**
     * @return \yii\web\Response
     * @throws ForbiddenHttpException
     * @throws \yii\db\Exception
     */
    public function actionMultipledelete()
    {
            $pk = Yii::$app->request->post('row_id');
            foreach ($pk as $key => $value)
            {
                $sql = "DELETE FROM {{%dutylist}} WHERE id = $value";
                $query = Yii::$app->db->createCommand($sql)->execute();
            }

            return $this->redirect(['index']);
    }

    public function actionMultipledeactivate()
    {
        $pk = Yii::$app->request->post('row_id');
        $val = 1;
        Dutylist::updateAll(['state' => $val], ['in', 'id', $pk]);

        return $this->redirect(['index']);

    }

    public function actionMultipleactivate()
    {
        $pk = Yii::$app->request->post('row_id');
        $val = 0;
        Dutylist::updateAll(['state' => $val], ['in', 'id', $pk]);

        return $this->redirect(['index']);

    }      

    public function actionValidation()
    {
        $model = new Dutylist();
        if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post()))
        {
            Yii::$app->response->format = 'json';
            return ActiveForm::validate($model);
        }
    }


    public function actionExport(){

            $objPHPExcel = new \PHPExcel();         
            
            // № листа
            $sheet=0;
            
            // № строки с которой начинаются табличные данные
            $row=4;

            // № строки заголовка
            $titleNumber=1;   

            $objPHPExcel->setActiveSheetIndex($sheet);
     
            $model = new Dutylist();

            $keyList = Yii::$app->request->post('keyList');
            $keyListArray = explode(',', $keyList);

            $query = Dutylist::find();      
            // $query->where(['<>','private', 1]);
            $query->where(['id' => $keyListArray]);
            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);
                     
            // Размер листа, ориентация
            $objPHPExcel->getActiveSheet()
                ->getPageSetup()
                ->setOrientation(\PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
            $objPHPExcel->getActiveSheet()
                ->getPageSetup()
                ->setPaperSize(\PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
            
            // Автофильтр
            $objPHPExcel->getActiveSheet()->setAutoFilter('A'.($row-1).':E'.($row-1));

            // Слияние ячеек в заголовке таблицы
            $objPHPExcel->getActiveSheet()->mergeCells('A'.$titleNumber.':E'.$titleNumber);

            // Жирный шрифт в заголовке
            $objPHPExcel->getActiveSheet()->getStyle('A'.($row-1).':E'.($row-1))->getFont()->setBold(true);

            // Жирный шрифт в заголовках колонок
            $objPHPExcel->getActiveSheet()->getStyle('A'.$titleNumber)->getFont()->setBold(true);

            // Заголовки колонок
            $objPHPExcel->getActiveSheet()->setTitle(Yii::t('app','DUTYLIST').date("d-m-Y-H-i"))                
                ->setCellValue('A'.($row-1), $model->getAttributeLabel('employee'))
                ->setCellValue('B'.($row-1), $model->getAttributeLabel('date'))
                ->setCellValue('C'.($row-1), $model->getAttributeLabel('state'))
                ->setCellValue('D'.($row-1), $model->getAttributeLabel('created_at'))
                ->setCellValue('E'.($row-1), $model->getAttributeLabel('updated_at'))
                ->setCellValue('E'.($row-1), $model->getAttributeLabel('author'));

            // Данные из запроса
            foreach ($dataProvider->models as $exportrows) {
                $objPHPExcel->getActiveSheet()->setCellValue('A'.$row,$exportrows->employee->fullName); 
                $objPHPExcel->getActiveSheet()->setCellValue('B'.$row,date("d/m/Y", strtotime($exportrows->date))); 
                $objPHPExcel->getActiveSheet()->setCellValue('C'.$row,$model->getStatesArray()[$exportrows->state]);
                $objPHPExcel->getActiveSheet()->setCellValue('D'.$row,gmdate("d/m/Y H:i", $exportrows->created_at)); 
                $objPHPExcel->getActiveSheet()->setCellValue('E'.$row,gmdate("d/m/Y H:i", $exportrows->updated_at)); 
                $objPHPExcel->getActiveSheet()->setCellValue('E'.$row,$exportrows->authorname->fullName);
                $row++ ;
            }  

            // Excel list header
            $objPHPExcel->getActiveSheet()
                ->getHeaderFooter()
                ->setOddHeader('&R&B'.Yii::t('app', 'DUTYLIST'));

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


            $objPHPExcel->getActiveSheet()->getStyle('A3:E'.($row-1))->applyFromArray($headercolors);
            $objPHPExcel->getActiveSheet()->getStyle('A3:E3')->applyFromArray($fontheadercolors);

            $objPHPExcel->getActiveSheet()->getStyle('A4:E'.($row-1))->applyFromArray($colors);
            $objPHPExcel->getActiveSheet()->getStyle('A4:E'.($row-1))->applyFromArray($tablefont);


            $objPHPExcel->getActiveSheet()->getStyle("A3:E".($rowNumber))->applyFromArray($border_thin);
            unset($styleArray);

            // Ширина колонок таблицы
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(35);
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
            $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(25);

            // Заголовок по центру
            $objPHPExcel->getActiveSheet()->getStyle('A'.$titleNumber.':H'.$titleNumber)->applyFromArray($centered);

            // Текст заголовка
            $objPHPExcel->getActiveSheet()->setCellValue('A'.$titleNumber, Yii::t('app', 'DUTYLIST') . date("d.m.Y H:i"));

            // Тип выгружаемого файла
            header('Content-Type: application/vnd.ms-excel');

            // Имя выгружаемого файла
            $filename = Yii::t('app','DUTYLIST').date("d-m-Y-H-i-s").".xls";

            header('Content-Disposition: attachment;filename='.$filename .' ');
            header('Cache-Control: max-age=0');
            $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            $objWriter->save('php://output'); 
        }

}
