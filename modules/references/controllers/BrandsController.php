<?php

namespace app\modules\references\controllers;

use Yii;
use app\modules\references\models\Brands;
use app\modules\references\models\BrandsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
 
/**
 * BrandsController implements the CRUD actions for Brands model.
 */
class BrandsController extends Controller
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
     * Lists all Brands models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BrandsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Brands model.
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
     * Creates a new Brands model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    
    public function actionCreate()
    {
        $model = new Brands();

        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
        if ($model->load(Yii::$app->request->post())) {

            // $imageName = mktime(date('h'), date('i'), date('s'), date('d'), date('m'), date('y'));
            $imageName = $model->brand;
            $model->file = UploadedFile::getInstance($model, 'file');

            // $model->file->saveAs('img/uploads/brandlogo/'.$imageName.'.'.$model->file->extension);
            // $model->brand_logo = 'img/uploads/brandlogo/'.$imageName.'.'.$model->file->extension; 
            // $model->save();

            if ($model->file = UploadedFile::getInstance($model, 'file'))
            {
                $model->file->saveAs('img/uploads/brandlogo/'.$imageName.'.'.$model->file->extension);
                $model->brand_logo = 'img/uploads/brandlogo/'.$imageName.'.'.$model->file->extension;                
            }

            if($model->save())
            {

               $model->id = $model->getPrimaryKey();
               return $this->redirect(['view', 'id' => $model->id]);
            }
            else
            {
                print_r($model->getErrors()); // => check whether any validation errors are there
            }            
            // $model->save(false);
            
            // return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    // public function actionCreate()
    // {
    //     $model = new Brands();

    //     if ($model->load(Yii::$app->request->post()) && $model->save()) {
    //         return $this->redirect(['view', 'id' => $model->id]);
    //     } else {
    //         return $this->render('create', [
    //             'model' => $model,
    //         ]);
    //     }
    // }

    /**
     * Updates an existing Brands model.
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
     * Deletes an existing Brands model.
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
     * Finds the Brands model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Brands the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Brands::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
