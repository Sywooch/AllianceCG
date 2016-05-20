<?php

namespace app\modules\alliance\controllers;

use app\modules\alliance\models\CalendarComments;
use Yii;
use app\modules\alliance\models\Creditcalendar;
use app\modules\alliance\models\CreditcalendarSearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\HttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;
use app\modules\alliance\Module;
use yii\helpers\ArrayHelper;

/**
 * CreditcalendarController implements the CRUD actions for Creditcalendar model.
 */
class CreditcalendarController extends Controller
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
                    'export' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Creditcalendar models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new Creditcalendar();
        $searchModel = new CreditcalendarSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'model' => $model,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all Creditcalendar models.
     * @return mixed
     */
    public function actionPrivate()
    {
        $model = new Creditcalendar();
        $searchModel = new CreditcalendarSearch();
        $dataProvider = $searchModel->personalsearch(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'model' => $model,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionCalendarsearch()
    {
        $this->layout = false;
        $model = new CreditcalendarSearch();
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
        $model = new Creditcalendar();
        $searchModel = new CreditcalendarSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('calendar', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }    

    /**
     * Displays a single Creditcalendar model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);        

        if($model->private == 1 && !Yii::$app->user->can('viewCreditcalendarOwnPost', ['creditcalendar' => $model]))
        {
            throw new HttpException(403, Module::t('module', 'ONLY_CHIEFCREDIT_CAN_DO_THERE'));
        }
        else
        {
            return $this->render('view', [
                'model' => $model,
            ]);
        }
    }

    public function actionComment($id)
    {
        $model = $this->findModel($id);
        $commentModel = new CalendarComments();

        if ($commentModel->load(Yii::$app->request->post())) {
            $commentModel->calendar_id = $model->id;
            $commentModel->user_id = Yii::$app->user->getId();
            $commentModel->save();

            if($commentModel->save()){
                $author_email[] = $model->authorname->email;
                foreach($model->users as $email)
                {
                    $responsibles_mail[] = $email->email;
                }
                $summaryEmails = ArrayHelper::merge($author_email, $responsibles_mail);

                Yii::$app->mailer->compose(['html' => '@app/modules/alliance/mails/creditcalendar/newCreditCalendarComment'], [
                        'id' => $model->id,
                        'title' => $model->title,
                        'comment_text' => $commentModel->comment_text,
                    ])
                    ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name])
                    ->setReplyTo(Yii::$app->params['supportEmail'])
                    ->setSubject(date('d/m/Y H:i:s') . '. ' . Module::t('module', 'NEW_CREDITCALENDAR_COMMENT') . ' ' . $model->title)
                    ->setTextBody($commentModel->comment_text)
                    ->setTo($summaryEmails)
                    ->send();
                }
            return $this->redirect(['view', 'id' => $model->id]);

        } else {
            return $this->renderAjax('comment', [
                'model' => $model,
                'commentModel' => $commentModel,
            ]);
        }

    }

    /**
     * Creates a new Creditcalendar model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        $formatter = new \yii\i18n\Formatter;
        $formatter->timeZone = 'Europe/Minsk';
        $formatter->dateFormat = 'php:Y-m-d';
        $formatter->timeFormat = 'php:h:i';

        $curdate = $formatter->asDate('now');        
        $curtime = $formatter->asTime('now');
        $tomorrow = $formatter->asDate('now + 1 day'); 
        
        $model = new Creditcalendar();
        
        $model->date_from = $curdate;
        $model->time_from = $curtime;
        $model->date_to = $tomorrow;
        $model->time_to = $curtime;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Creditcalendar model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if (!Yii::$app->user->can('updateCreditcalendarOwnPost', ['creditcalendar' => $model]) && !Yii::$app->user->can('updateCreditcalendarPost')) {
            throw new ForbiddenHttpException(Module::t('module', 'ONLY_AUTHOR_CAN_UPDATE_THIS_RECORD'));
        }
        else
        {

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Deletes an existing Creditcalendar model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (!Yii::$app->user->can('deleteCreditcalendarPost')) {
            throw new ForbiddenHttpException(Module::t('module', 'ONLY_CHIEFCREDIT_CAN_DELETE_THERE'));
        }
        else {
            $this->findModel($id)->delete();
            return $this->redirect(['index']);
        }
    }

    /**
     * @return \yii\web\Response
     * @throws ForbiddenHttpException
     * @throws \yii\db\Exception
     */
    public function actionMultipledelete()
    {
        if (!Yii::$app->user->can('deleteCreditcalendarPost')) {
            throw new ForbiddenHttpException(Module::t('module', 'ONLY_CHIEFCREDIT_CAN_DELETE_THERE'));
        }
        else {
            $pk = Yii::$app->request->post('row_id');
            foreach ($pk as $key => $value)
            {
                $sql = "DELETE FROM {{%calendar}} WHERE id = $value";
                $query = Yii::$app->db->createCommand($sql)->execute();
            }

            return $this->redirect(['index']);
        }
    }

    /**
     * Finds the Creditcalendar model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Creditcalendar the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Creditcalendar::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionExport(){
        if (!Yii::$app->user->can('deleteCreditcalendarPost')) {
            throw new ForbiddenHttpException(Module::t('module', 'ONLY_CHIEFCREDIT_CAN_EXPORT_EXCEL'));
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
     
            $model = new Creditcalendar();

            $keyList = Yii::$app->request->post('keyList');
            $keyListArray = explode(',', $keyList);

            $query = Creditcalendar::find();      
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
            $objPHPExcel->getActiveSheet()->setAutoFilter('A'.($row-1).':H'.($row-1));

            // Слияние ячеек в заголовке таблицы
            $objPHPExcel->getActiveSheet()->mergeCells('A'.$titleNumber.':H'.$titleNumber);

            // Жирный шрифт в заголовке
            $objPHPExcel->getActiveSheet()->getStyle('A'.($row-1).':H'.($row-1))->getFont()->setBold(true);

            // Жирный шрифт в заголовках колонок
            $objPHPExcel->getActiveSheet()->getStyle('A'.$titleNumber)->getFont()->setBold(true);

            // Заголовки колонок
            $objPHPExcel->getActiveSheet()->setTitle(Module::t('module','CREDITCALENDAR_EXCEL_TITLE').date("d-m-Y-H-i"))                
                ->setCellValue('A'.($row-1), $model->getAttributeLabel('title'))
                ->setCellValue('B'.($row-1), $model->getAttributeLabel('date_from'))
                ->setCellValue('C'.($row-1), $model->getAttributeLabel('date_to'))
                ->setCellValue('D'.($row-1), $model->getAttributeLabel('author'))
                ->setCellValue('E'.($row-1), $model->getAttributeLabel('responsibles'))
                ->setCellValue('F'.($row-1), $model->getAttributeLabel('locations'))
                ->setCellValue('G'.($row-1), $model->getAttributeLabel('status'))
                ->setCellValue('H'.($row-1), $model->getAttributeLabel('priority'));

            // Данные из запроса
            foreach ($dataProvider->models as $exportrows) {
                $objPHPExcel->getActiveSheet()->setCellValue('A'.$row,$exportrows->title); 
                $objPHPExcel->getActiveSheet()->setCellValue('B'.$row,$exportrows->date_from . ' ' . $exportrows->time_from); 
                $objPHPExcel->getActiveSheet()->setCellValue('C'.$row,$exportrows->date_to . ' ' . $exportrows->time_to); 
                $objPHPExcel->getActiveSheet()->setCellValue('D'.$row,$exportrows->authorname->full_name); 
                $objPHPExcel->getActiveSheet()->setCellValue('E'.$row,implode(', ', ArrayHelper::map($exportrows->users, 'id', 'full_name')));
                $objPHPExcel->getActiveSheet()->setCellValue('F'.$row,implode(', ', ArrayHelper::map($exportrows->locations, 'id', 'company_name')));
                $objPHPExcel->getActiveSheet()->setCellValue('G'.$row,$model->getStatusesArray()[$exportrows->status]);
                $objPHPExcel->getActiveSheet()->setCellValue('H'.$row,$model->getPrioritiesArray()[$exportrows->status]);
                $row++ ;
            }  

            // Excel list header
            $objPHPExcel->getActiveSheet()
                ->getHeaderFooter()
                ->setOddHeader('&R&B'.Module::t('module', 'CREDITCALENDAR_HEADER_TEXT'));

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
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
            $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
            $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
            $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(13);
            $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(13);

            // Заголовок по центру
            $objPHPExcel->getActiveSheet()->getStyle('A'.$titleNumber.':H'.$titleNumber)->applyFromArray($centered);

            // Текст заголовка
            $objPHPExcel->getActiveSheet()->setCellValue('A'.$titleNumber, Module::t('module', 'CREDITCALENDAR_EXCEL_TABLEHEADER') . date("d.m.Y H:i"));
            // $objPHPExcel->getActiveSheet()->setCellValue('A'.($titleNumber+1), $rowNumber);

            // Тип выгружаемого файла
            header('Content-Type: application/vnd.ms-excel');

            // Имя выгружаемого файла
            $filename = Module::t('module','CREDITCALENDAR_EXCEL_TITLE').date("d-m-Y-H-i-s").".xls";

            header('Content-Disposition: attachment;filename='.$filename .' ');
            header('Cache-Control: max-age=0');
            $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            $objWriter->save('php://output'); 
        }
    }     

}
