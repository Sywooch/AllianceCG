<?php

namespace app\modules\references\controllers;

use Yii;
use app\modules\references\models\Regions;
use app\modules\references\models\RegionsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

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
                        'actions'=>['create', 'update', 'multipledelete', 'multiplerestore', 'delete', 'importexcel'],
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

    public function actionImportexcel()
    {
        $inputDir = Regions::DIR_FOR_UPLOAD;
        if (!file_exists(''.$inputDir.'')) {
            mkdir(''.$inputDir.'', 0777, true);
        }
        // $inputFile = ''.$inputDir.'regions.xlsx';
        $inputFile = ''.$inputDir.Regions::XLSX_FILE_FOR_UPLOAD;
        if (!file_exists(''.$inputFile.'')) {
            Yii::$app->getSession()->setFlash('error', 'Отсутствует файл для загрузки.');  
            return $this->render('importExcel');     
            die("");
        }
        else{
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

                $regions = new RegionsSearch();
                // $regions->region_name = date($format = "Y-m-d", \PHPExcel_Shared_Date::ExcelToPHP($rowData[0][0])); 
                $regions->region_name = $rowData[0][0]; 
                $regions->region_code = $rowData[0][1];
                $regions->author = Yii::$app->user->getId();
                $regions->save();
                if($regions->getErrors()){
                    print_r($regions->getErrors());                    
                }
            }           
            Yii::$app->getSession()->setFlash('success', 'Импорт Выполнен.');   
            return $this->render('importExcel', [
                'model' => $regions,
            ]);     
            die();
        }

    }


}
