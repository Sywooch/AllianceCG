<?php

namespace app\modules\skoda\controllers;

use Yii;
use app\modules\skoda\models\Servicesheduler;
use app\modules\skoda\models\ServiceshedulerSearch;
use app\modules\skoda\Module;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ServiceshedulerController implements the CRUD actions for Servicesheduler model.
 */
class ServiceshedulerController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Servicesheduler models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new Servicesheduler();
        $searchModel = new ServiceshedulerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }
    
    public function actionExport(){


    }      

    public function actionCalendar()
    {

        $model = new Servicesheduler();
                
        return $this->render('calendar', [
            'model' => $model,         
            ]);
    }
    
    public function actionCalendarsearch()
    {
        $this->layout = false;
        $model = new ServiceshedulerSearch();
        return $this->render('_calendarSearch', [
            'model' => $model,
        ]);
    }

    /**
     * Displays a single Servicesheduler model.
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
     * Creates a new Servicesheduler model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Servicesheduler();
        
        if (isset($_GET['date'])){
            $model->date = $_GET['date'];
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

//     public function actionImportExcel()
//     {
//         $inputDir = 'uploads/servicesheduler/';
//         if (!file_exists(''.$inputDir.'')) {
//             mkdir(''.$inputDir.'', 0777, true);
//         }
//         $inputFile = ''.$inputDir.'servicesheduler.xlsx';
//         if (!file_exists(''.$inputFile.'')) {
//             die("File Not Found");
//         }
//         else{
//             try{
//                 $inputFileType = \PHPExcel_IOFactory::identify($inputFile);
//                 $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
//                 $objPHPExcel = $objReader->load($inputFile);
//             }catch(Exception $e){
//                 die('Error');
//             }
//             $sheet = $objPHPExcel->getSheet(0);
//             $highestRow = $sheet->getHighestRow();
//             $highestColumn = $sheet->getHighestColumn();        
//             for($row = 1; $row <= $highestRow; $row++){
//                 $rowData = $sheet->rangeToArray('A'.$row.':'.$highestColumn.$row,NULL,TRUE,FALSE);
//                 if($row == 1)
//                 {
//                     continue;
//                 }

// //                $dateRowData = date($format = "Y-m-d", \PHPExcel_Shared_Date::ExcelToPHP($rowData[0][0])); 

//                 $servicesheduler = new ServiceshedulerSearch();
//                 $servicesheduler->date = date($format = "Y-m-d", \PHPExcel_Shared_Date::ExcelToPHP($rowData[0][0])); 
//                 $servicesheduler->responsible = $rowData[0][1];
//                 $servicesheduler->save();
//                 if($servicesheduler->getErrors()){
//                     print_r($servicesheduler->getErrors());                    
//                 }
//             }        
//             die("okay");
//         }
//     }
    
    /**
     * Updates an existing Servicesheduler model.
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
     * Deletes an existing Servicesheduler model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    // public function actionDelete($id)
    // {
    //     $this->findModel($id)->delete();

    //     return $this->redirect(['index']);
    // }

    public function actionMultipledelete()
    {
        $pk = Yii::$app->request->post('row_id');
        $val = Servicesheduler::STATUS_BLOCKED;
        Servicesheduler::updateAll(['state' => $val], ['in', 'id', $pk]);

        return $this->redirect(['index']);

    }

    public function actionMultiplerestore()
    {
        $pk = Yii::$app->request->post('row_id');
        $val = Servicesheduler::STATUS_ACTIVE;
        Servicesheduler::updateAll(['state' => $val], ['in', 'id', $pk]);

        return $this->redirect(['index']);

    }   

    /**
     * Finds the Servicesheduler model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Servicesheduler the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Servicesheduler::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
