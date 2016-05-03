<?php

namespace app\modules\alliance\controllers;

use app\modules\alliance\models\CalendarComments;
use Yii;
use app\modules\alliance\models\Creditcalendar;
use app\modules\alliance\models\CreditcalendarSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\HttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;
use app\modules\alliance\Module;

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

        if (!Yii::$app->user->can('updateCreditcalendarPost', ['creditcalendar' => $model])) {
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

        $objPHPExcel = new \PHPExcel();
         
        $sheet=0;
          
        $objPHPExcel->setActiveSheetIndex($sheet);

        $labelModel = new Creditcalendar();

        $model = CreditcalendarSearch::find()
            ->where(['<>','private', 1])
            ->all();
                 
        $objPHPExcel->getActiveSheet()
            ->getPageSetup()
            ->setOrientation(\PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
        $objPHPExcel->getActiveSheet()
            ->getPageSetup()
            ->setPaperSize(\PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

        
        // $objPHPExcel->getActiveSheet()->getColumnDimensionByColumn('A2:F2')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->mergeCells('A1:F1');
        $objPHPExcel->getActiveSheet()->getStyle('A2:F2')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->setTitle('xxx')                     
            ->setCellValue('A2', $labelModel->getAttributeLabel('title'))
            ->setCellValue('B2', $labelModel->getAttributeLabel('date_from'))
            ->setCellValue('C2', $labelModel->getAttributeLabel('date_to'))
            ->setCellValue('D2', $labelModel->getAttributeLabel('description'))
            ->setCellValue('E2', $labelModel->getAttributeLabel('status'))
            ->setCellValue('F2', $labelModel->getAttributeLabel('priority'));

        $objPHPExcel->getActiveSheet()
            ->getHeaderFooter()
            ->setOddHeader('&L&BКалендарь отдела кредитования, страхования и лизинга ГК "Альянс"');
        $objPHPExcel->getActiveSheet()
            ->getHeaderFooter()
            ->setOddFooter('&L&B' . $objPHPExcel->getProperties()->getTitle() );   

        // $rowNumber = 8;
        // $rowNumber = $objPHPExcel->setActiveSheetIndex()->getHighestRow();
        $rowNumber = $objPHPExcel->setActiveSheetIndex()->getHighestRow();  

        $styleArray = [
          'borders' => [
            'allborders' => [
              'style' => \PHPExcel_Style_Border::BORDER_THIN
            ]
          ]
        ];

        $objPHPExcel->getActiveSheet()->getStyle("A2:F".($rowNumber+1))->applyFromArray($styleArray);
        unset($styleArray);

        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(18);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(18);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(13);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
                 
        $row=3;
                                
        foreach ($model as $exportrows) {

            $objPHPExcel->getActiveSheet()->setCellValue('A'.$row,$exportrows->title); 
            $objPHPExcel->getActiveSheet()->setCellValue('B'.$row,$exportrows->date_from . ' ' . $exportrows->time_from); 
            $objPHPExcel->getActiveSheet()->setCellValue('C'.$row,$exportrows->date_to . ' ' . $exportrows->time_to); 
            $objPHPExcel->getActiveSheet()->setCellValue('D'.$row,$exportrows->description);
            // $objPHPExcel->getActiveSheet()->setCellValue('E'.$row,$exportrows->status);
            $objPHPExcel->getActiveSheet()->setCellValue('E'.$row,$labelModel->getStatusesArray()[$exportrows->status]);
            // $objPHPExcel->getActiveSheet()->setCellValue('F'.$row,$exportrows->priority);
            $objPHPExcel->getActiveSheet()->setCellValue('F'.$row,$labelModel->getPrioritiesArray()[$exportrows->status]);
            $row++ ;
        }  
                        
        header('Content-Type: application/vnd.ms-excel');
        $filename = "Календарь_ОКиС_".date("d-m-Y-H-i-s").".xls";
        header('Content-Disposition: attachment;filename='.$filename .' ');
        header('Cache-Control: max-age=0');
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output'); 
    }     

}
