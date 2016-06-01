<?php

namespace app\modules\references\controllers;

use Yii;
use app\modules\references\models\Employees;
use app\modules\references\models\EmployeesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;

/**
 * EmployeesController implements the CRUD actions for Employees model.
 */
class EmployeesController extends Controller
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
                        'roles' => ['seniorcreditspesialist', 'chiefcredit', 'admin', 'root', 'accessCreditReferences'],
                    ],
                    [
                        'allow' => true,
                        'actions'=>['create', 'update', 'multipledelete', 'multiplerestore', 'delete'],
                        'roles' => ['admin', 'root'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Employees models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EmployeesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Employees model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Employees model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Employees();

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->file = UploadedFile::getInstance($model, 'file')){
                $imageName = mktime(date('h'), date('i'), date('s'), date('d'), date('m'), date('y'));
                $path = Employees::PHOTO_PATH;
                if(!file_exists($path)) {
                    mkdir($path, 0777);
                } 
                $model->photo = $path.$imageName.'.'.$model->file->extension;
                $model->save(); 
                $model->file->saveAs($path.$imageName.'.'.$model->file->extension);
            }
            else {
                $model->save();
            }
            
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    // public function actionCreate()
    // {
    //     $model = new Employees();

    //     if ($model->load(Yii::$app->request->post()) && $model->save()) {
    //         return $this->redirect(['view', 'id' => $model->id]);
    //     } else {
    //         return $this->render('create', [
    //             'model' => $model,
    //         ]);
    //     }
    // }    

    /**
     * Updates an existing Employees model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->file = UploadedFile::getInstance($model, 'file')){
                if (isset($model->photo) && !empty($model->photo) && file_exists($model->photo))
                {
                    unlink($model->photo);
                }                
                $imageName = mktime(date('h'), date('i'), date('s'), date('d'), date('m'), date('y'));
                $path = Employees::PHOTO_PATH;
                if(!file_exists($path)) {
                    mkdir($path, 0777);
                } 
                $model->photo = $path.$imageName.'.'.$model->file->extension;
                $model->save(); 
                $model->file->saveAs($path.$imageName.'.'.$model->file->extension);
            }
            else {
                $model->save();
            }

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
    // public function actionUpdate($id)
    // {
    //     $model = $this->findModel($id);

    //     if ($model->load(Yii::$app->request->post()) && $model->save()) {
    //         return $this->redirect(['view', 'id' => $model->id]);
    //     } else {
    //         return $this->render('update', [
    //             'model' => $model,
    //         ]);
    //     }
    // }

    /**
     * Deletes an existing Employees model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    // public function actionDelete($id)
    // {
    //     // $this->findModel($id)->delete();
    //     $model = $this->findModel($id);
    //     $file = $model->photo;
    //     if (isset($file))
    //     {
    //         unlink($file);
    //     }
    //     $model->delete();

    //     return $this->redirect(['index']);
    // }     


    /**
     * Finds the Employees model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Employees the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Employees::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionMultipledelete()
    {
        $pk = Yii::$app->request->post('row_id');
        $val = 1;
        Employees::updateAll(['state' => $val], ['in', 'id', $pk]);

        return $this->redirect(['index']);

    }

    public function actionMultiplerestore()
    {
        $pk = Yii::$app->request->post('row_id');
        $val = 0;
        Employees::updateAll(['state' => $val], ['in', 'id', $pk]);

        return $this->redirect(['index']);

    }  
}
