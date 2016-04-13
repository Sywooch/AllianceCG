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
        $model = ServiceshedulerSearch::find()->All();
        $filename = 'Servicesheduler-'.Date('Y-m-d-H-i-s').'.xls';
        echo '<meta http-equiv="Content-type" content="text/html; charset=utf-8" />';
        header("Content-type: application/vnd-ms-excel; charset=utf-8");
        header("Content-Transfer-Encoding: binary");
//        header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        header("Content-Disposition: attachment; filename=".$filename);
        header('Pragma: no-cache');
        echo '<table border="1" width="100%">
            <thead>
                <tr>
                    <th>Дата</th>
                    <th>Мастер-консультант</th>
                </tr>
            </thead>';
            foreach($model as $data){
                echo '
                    <tr>
                        <td>'.$data['date'].'</td>
                        <td>'.$data['responsible'].'</td>
                    </tr>
                ';
            }
        echo '</table>';

    }       
    
    public function actionList()
    {
        $model = new ServiceshedulerSearch();
        $dataProvider = $model->search(Yii::$app->request->queryParams);
        
        return $this->render('list', [
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
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

    public function actionImportExcel()
    {
        $inputFile = 'uploads/servicesheduler/servicesheduler.xlsx';
        try{
            $inputFileType = \PHPExcel_IOFactory::identify($inputFile);
            $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($inputFile);
        }catch(Exception $e){
            die('Error');
        }
        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();        
        for($row = 1; $row <= $highestRow; $row++){
            $rowData = $sheet->rangeToArray('A'.$row.':'.$highestColumn.$row,NULL,TRUE,FALSE);
            if($row == 1)
            {
                continue;
            }
            
            $dateRowData = date($format = "Y-m-d", \PHPExcel_Shared_Date::ExcelToPHP($rowData[0][0])); 
            
            $servicesheduler = new ServiceshedulerSearch();
            $servicesheduler->date = $dateRowData;
            $servicesheduler->responsible = $rowData[0][1];
            $servicesheduler->save();
            print_r($servicesheduler->getErrors());            
        }        
        die("okay");        
    }
    
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
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionMultipledelete()
    {
        $pk = Yii::$app->request->post('row_id');

        foreach ($pk as $key => $value) 
        {
            $sql = "DELETE FROM {{%servicesheduler}} WHERE id = $value";
            $query = Yii::$app->db->createCommand($sql)->execute();
        }

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
