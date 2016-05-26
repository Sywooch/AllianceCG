<?php

namespace app\modules\references\controllers;

use Yii;
use app\modules\references\models\Regions;
use app\modules\references\models\RegionsSearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;

/**
 * RegionsController implements the CRUD actions for Regions model.
 */
class RegionsController extends Controller
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
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions'=>['index', 'view'],
                        'roles' => ['seniorcreditspesialist', 'chiefcredit', 'admin', 'root'],
                    ],
                    [
                        'allow' => true,
                        'actions'=>['create', 'update', 'multipledelete', 'multiplerestore', 'delete', 'importexcel', 'export', 'upload'],
                        'roles' => ['admin', 'root'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Regions models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RegionsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Regions model.
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
     * Creates a new Regions model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Regions();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Regions model.
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
     * Deletes an existing Regions model.
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
     * Finds the Regions model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Regions the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Regions::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionMultipledelete()
    {
        $pk = Yii::$app->request->post('row_id');
        $val = Regions::STATUS_BLOCKED;
        Regions::updateAll(['state' => $val], ['in', 'id', $pk]);

        return $this->redirect(['index']);

    }

    public function actionMultiplerestore()
    {
        $pk = Yii::$app->request->post('row_id');
        $val = Regions::STATUS_ACTIVE;
        Regions::updateAll(['state' => $val], ['in', 'id', $pk]);

        return $this->redirect(['index']);

    } 

    // public function actionImportexcel()
    // {
    //     $inputDir = Regions::DIR_FOR_UPLOAD;
    //     if (!file_exists(''.$inputDir.'')) {
    //         mkdir(''.$inputDir.'', 0777, true);
    //     }
    //     // $inputFile = ''.$inputDir.'regions.xlsx';
    //     $inputFile = ''.$inputDir.Regions::XLSX_FILE_FOR_UPLOAD;
    //     if (!file_exists(''.$inputFile.'')) {
    //         Yii::$app->getSession()->setFlash('error', 'Отсутствует файл для загрузки.');  
    //         return $this->render('importExcel');     
    //         die("");
    //     }
    //     else{
    //         try{
    //             $inputFileType = \PHPExcel_IOFactory::identify($inputFile);
    //             $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
    //             $objPHPExcel = $objReader->load($inputFile);
    //         }catch(Exception $e){
    //             die('Error');
    //         }
    //         $sheet = $objPHPExcel->getSheet(0);
    //         $highestRow = $sheet->getHighestRow();
    //         $highestColumn = $sheet->getHighestColumn();        
    //         for($row = 1; $row <= $highestRow; $row++){
    //             $rowData = $sheet->rangeToArray('A'.$row.':'.$highestColumn.$row,NULL,TRUE,FALSE);
    //             if($row == 1)
    //             {
    //                 continue;
    //             }

    //             $regions = new RegionsSearch();
    //             // $regions->region_name = date($format = "Y-m-d", \PHPExcel_Shared_Date::ExcelToPHP($rowData[0][0])); 
    //             $regions->region_name = $rowData[0][0]; 
    //             $regions->region_code = $rowData[0][1];
    //             $regions->author = Yii::$app->user->getId();
    //             $regions->save();
    //             if($regions->getErrors()){
    //                 print_r($regions->getErrors());                    
    //             }
    //         }           
    //         Yii::$app->getSession()->setFlash('success', 'Импорт Выполнен.');   
    //         return $this->render('importExcel', [
    //             'model' => $regions,
    //         ]);     
    //         die();
    //     }

    // }


    public function actionUpload()
    {

        $model = new Regions();

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->xlsxFile = UploadedFile::getInstance($model, 'xlsxFile')){
                $fileName = Regions::XLSX_FILE_FOR_UPLOAD;
                $path = Regions::DIR_FOR_UPLOAD;
                if(!file_exists($path)) {
                    mkdir($path, 0777, true);
                } 
                // $model->xlsxFile->saveAs($path.$fileName.'.'.$model->xlsxFile->extension);
                $model->xlsxFile->saveAs($path.$fileName.'.'.$model->xlsxFile->extension);
            }
            
        // $inputFile = ''.SourceMessage::DIR_FOR_UPLOAD.SourceMessage::XLSX_FILE_FOR_UPLOAD.SourceMessage::UPLOAD_FILE_EXT;
        $inputFile = 'files/regions/regions.xlsx';
        if (!file_exists(''.$inputFile.'')) {
            Yii::$app->getSession()->setFlash('error', 'Отсутствует файл для загрузки.');  
            return $this->render('importExcel');     
            die("");
        }
        else{
            try{
                Regions::deleteAll();
                $inputFileType = \PHPExcel_IOFactory::identify($inputFile);
                $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFile);
            }catch(Exception $e){
                die('Error');
            }
            $sheet = $objPHPExcel->getSheet(0);
            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestDataColumn();        
            for($row = 1; $row <= $sheet->getHighestRow(); $row++){

                $rowData = $sheet->rangeToArray('A'.$row.':'.$highestColumn.$row,NULL,TRUE,FALSE);
                if($row == 1)
                {
                    continue;
                }

                $sourcemsg = new RegionsSearch();
                $sourcemsg->region_name = $rowData[0][0]; 
                $sourcemsg->region_code = $rowData[0][1];
                $sourcemsg->author = Yii::$app->user->getId();
                $sourcemsg->save();
                if($sourcemsg->getErrors()){
                    print_r($sourcemsg->getErrors());                    
                }
            }          
            unlink($inputFile); 
            Yii::$app->getSession()->setFlash('success', 'Импорт Выполнен.');   
            return $this->render('importExcel', [
                'model' => $sourcemsg,
            ]);     
            die();
        }

            // return $this->render('uploadFile');
            // return $this->redirect('index');
        } else {
            return $this->render('uploadFile', [
                'model' => $model,
            ]);
        }
    }

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
     
            $model = new Regions();

            // Получить id отмеченных записей (преобразовать полученный массив в строку)
            // $keyList = Yii::$app->request->post('keyList');
            // $keyListArray = explode(',', $keyList);

            $query = Regions::find();
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
            $objPHPExcel->getActiveSheet()->setAutoFilter('A'.($row-1).':B'.($row-1));

            // Слияние ячеек в заголовке таблицы
            $objPHPExcel->getActiveSheet()->mergeCells('A'.$titleNumber.':B'.$titleNumber);

            // Жирный шрифт в заголовке
            $objPHPExcel->getActiveSheet()->getStyle('A'.($row-1).':B'.($row-1))->getFont()->setBold(true);

            // Жирный шрифт в заголовках колонок
            $objPHPExcel->getActiveSheet()->getStyle('A'.$titleNumber)->getFont()->setBold(true);

            // Заголовки колонок
            $objPHPExcel->getActiveSheet()->setTitle(Yii::t('app','TR_EXCEL_TITLE').date("d-m-Y-H-i"))                
                ->setCellValue('A'.($row-1), $model->getAttributeLabel('region_name'))
                ->setCellValue('B'.($row-1), $model->getAttributeLabel('region_code'))
                // ->setCellValue('C'.($row-1), $model->getAttributeLabel('created_at'))
                // ->setCellValue('D'.($row-1), $model->getAttributeLabel('author'))
                ;

            // Данные из запроса
            foreach ($dataProvider->models as $exportrows) {
                $objPHPExcel->getActiveSheet()->setCellValue('A'.$row,$exportrows->region_name); 
                $objPHPExcel->getActiveSheet()->setCellValue('B'.$row,$exportrows->region_code); 
                // $objPHPExcel->getActiveSheet()->setCellValue('C'.$row,implode(', ', ArrayHelper::map($exportrows->messages, 'language', 'language')));
                // $objPHPExcel->getActiveSheet()->setCellValue('D'.$row,implode(', ', ArrayHelper::map($exportrows->messages, 'translation', 'translation'))); 
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


            $objPHPExcel->getActiveSheet()->getStyle('A3:B'.($row-1))->applyFromArray($headercolors);
            $objPHPExcel->getActiveSheet()->getStyle('A3:B3')->applyFromArray($fontheadercolors);

            $objPHPExcel->getActiveSheet()->getStyle('A4:B'.($row-1))->applyFromArray($colors);
            $objPHPExcel->getActiveSheet()->getStyle('A4:B'.($row-1))->applyFromArray($tablefont);


            $objPHPExcel->getActiveSheet()->getStyle("A3:B".($rowNumber))->applyFromArray($border_thin);
            unset($styleArray);

            // Ширина колонок таблицы
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
            // $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
            // $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
            // Заголовок по центру
            $objPHPExcel->getActiveSheet()->getStyle('A'.$titleNumber.':B'.$titleNumber)->applyFromArray($centered);

            // Текст заголовка
            $objPHPExcel->getActiveSheet()->setCellValue('A'.$titleNumber, Yii::t('app', 'REGIONS_EXCEL_TABLEHEADER') . '_' . date("d.m.Y H:i"));
            // $objPHPExcel->getActiveSheet()->setCellValue('A'.($titleNumber+1), $rowNumber);

            // Тип выгружаемого файла
            // header('Content-Type: application/vnd.ms-excel'); // Excel < 2007
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); // Excel2007

            // Имя выгружаемого файла
            $filename = Yii::t('app','REGIONS_EXCEL_TITLE') . '_' . date("d-m-Y-H-i-s").".xlsx";

            header('Content-Disposition: attachment;filename='.$filename .' ');
            header('Cache-Control: max-age=0');

            $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007'); // Excel5 для выгрузки с расширением .xls
            $objWriter->save('php://output'); 
        }
    }     



}
