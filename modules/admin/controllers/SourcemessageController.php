<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\SourceMessage;
use app\modules\admin\models\SourceMessageSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\admin\models\Message;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

/**
 * SourcemessageController implements the CRUD actions for SourceMessage model.
 */
class SourcemessageController extends Controller
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
     * Lists all SourceMessage models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SourceMessageSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SourceMessage model.
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
     * Creates a new SourceMessage model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SourceMessage();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing SourceMessage model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $msgModel = Message::findOne($id);
        $model->language = $msgModel->language;
        $model->translation = $msgModel->translation;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing SourceMessage model.
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
     * Finds the SourceMessage model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SourceMessage the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SourceMessage::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
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
     
            $model = new SourceMessage();

            // Получить id отмеченных записей (преобразовать полученный массив в строку)
            // $keyList = Yii::$app->request->post('keyList');
            // $keyListArray = explode(',', $keyList);

            $query = SourceMessage::find();
            $query->joinWith('messages');
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
            $objPHPExcel->getActiveSheet()->setAutoFilter('A'.($row-1).':D'.($row-1));

            // Слияние ячеек в заголовке таблицы
            $objPHPExcel->getActiveSheet()->mergeCells('A'.$titleNumber.':D'.$titleNumber);

            // Жирный шрифт в заголовке
            $objPHPExcel->getActiveSheet()->getStyle('A'.($row-1).':D'.($row-1))->getFont()->setBold(true);

            // Жирный шрифт в заголовках колонок
            $objPHPExcel->getActiveSheet()->getStyle('A'.$titleNumber)->getFont()->setBold(true);

            // Заголовки колонок
            $objPHPExcel->getActiveSheet()->setTitle(Yii::t('app','TR_EXCEL_TITLE').date("d-m-Y-H-i"))                
                ->setCellValue('A'.($row-1), $model->getAttributeLabel('category'))
                ->setCellValue('B'.($row-1), $model->getAttributeLabel('message'))
                ->setCellValue('C'.($row-1), $model->getAttributeLabel('language'))
                ->setCellValue('D'.($row-1), $model->getAttributeLabel('translation'))
                ;

            // Данные из запроса
            foreach ($dataProvider->models as $exportrows) {
                $objPHPExcel->getActiveSheet()->setCellValue('A'.$row,$exportrows->category); 
                $objPHPExcel->getActiveSheet()->setCellValue('B'.$row,$exportrows->message); 
                $objPHPExcel->getActiveSheet()->setCellValue('C'.$row,implode(', ', ArrayHelper::map($exportrows->messages, 'language', 'language')));
                $objPHPExcel->getActiveSheet()->setCellValue('D'.$row,implode(', ', ArrayHelper::map($exportrows->messages, 'translation', 'translation'))); 
                $row++ ;
            }  

            // Excel list header
            $objPHPExcel->getActiveSheet()
                ->getHeaderFooter()
                ->setOddHeader('&R&B'.Yii::t('app', 'TRANSLATIONS_HEADER_TEXT'));

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


            $objPHPExcel->getActiveSheet()->getStyle('A3:D'.($row-1))->applyFromArray($headercolors);
            $objPHPExcel->getActiveSheet()->getStyle('A3:D3')->applyFromArray($fontheadercolors);

            $objPHPExcel->getActiveSheet()->getStyle('A4:D'.($row-1))->applyFromArray($colors);
            $objPHPExcel->getActiveSheet()->getStyle('A4:D'.($row-1))->applyFromArray($tablefont);


            $objPHPExcel->getActiveSheet()->getStyle("A3:D".($rowNumber))->applyFromArray($border_thin);
            unset($styleArray);

            // Ширина колонок таблицы
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
            // Заголовок по центру
            $objPHPExcel->getActiveSheet()->getStyle('A'.$titleNumber.':D'.$titleNumber)->applyFromArray($centered);

            // Текст заголовка
            $objPHPExcel->getActiveSheet()->setCellValue('A'.$titleNumber, Yii::t('app', 'TRANSLATION_EXCEL_TABLEHEADER') . '_' . date("d.m.Y H:i"));
            // $objPHPExcel->getActiveSheet()->setCellValue('A'.($titleNumber+1), $rowNumber);

            // Тип выгружаемого файла
            // header('Content-Type: application/vnd.ms-excel'); // Excel < 2007
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); // Excel2007

            // Имя выгружаемого файла
            $filename = Yii::t('app','TRANSLATION_EXCEL_TITLE') . '_' . date("d-m-Y-H-i-s").".xlsx";

            header('Content-Disposition: attachment;filename='.$filename .' ');
            header('Cache-Control: max-age=0');

            $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007'); // Excel5 для выгрузки с расширением .xls
            $objWriter->save('php://output'); 
        }
    }     

    public function actionGetmessages()
    {
        $msg_config_file = "@app/modules/main/messages/config.php";

        $exec_command = "php yii message/extract";

        exec("$exec_command $msg_config_file", $output, $return_var);

        return $this->redirect(Yii::$app->request->referrer);
    }


    public function actionImportexcel()
    {
        $inputDir = SourceMessage::DIR_FOR_UPLOAD;
        if (!file_exists(''.$inputDir.'')) {
            mkdir(''.$inputDir.'', 0777, true);
        }

        $inputFile = ''.$inputDir.SourceMessage::XLSX_FILE_FOR_UPLOAD;
        // $inputFile = 'files/sourcemessage/sourcemessage.xlsx';
        if (!file_exists(''.$inputFile.'')) {
            Yii::$app->getSession()->setFlash('error', 'Отсутствует файл для загрузки.');  
            return $this->render('importExcel');     
            die("");
        }
        else{
            try{
                SourceMessage::deleteAll();
                $inputFileType = \PHPExcel_IOFactory::identify($inputFile);
                $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFile);
            }catch(Exception $e){
                die('Error');
            }
            $sheet = $objPHPExcel->getSheet(0);
            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();        
            for($row = 4; $row <= $highestRow; $row++){

                $rowData = $sheet->rangeToArray('A'.$row.':'.$highestColumn.$row,NULL,TRUE,FALSE);
                if($row == 1)
                {
                    continue;
                }

                $sourcemsg = new SourceMessageSearch();
                $sourcemsg->category = $rowData[0][0]; 
                $sourcemsg->message = $rowData[0][1];
                $sourcemsg->language = $rowData[0][2];
                $sourcemsg->translation = $rowData[0][3];
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

    }    

}
