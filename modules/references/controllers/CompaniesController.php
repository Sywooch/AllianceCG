<?php

namespace app\modules\references\controllers;

use Yii;
use app\modules\references\models\Companies;
use app\modules\references\models\CompaniesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\filters\AccessControl;

/**
 * CompaniesController implements the CRUD actions for Companies model.
 */
class CompaniesController extends Controller
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
     * Lists all Companies models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new Companies();
        $searchModel = new CompaniesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionTest()
    {
        $this->layout = '@app/views/layouts/_navbarleft';
        return $this->render('test');
    }    

    // public function actionCreate()
    // {
    //     $model = new Companies();
 
    //     if ($model->load(Yii::$app->request->post())) {

    //         $imageName = mktime(date('h'), date('i'), date('s'), date('d'), date('m'), date('y'));
    //         $model->brandlogo = UploadedFile::getInstance($model, 'brandlogo');
    //         if ($model->brandlogo = UploadedFile::getInstance($model, 'brandlogo'))
    //         {
    //             $model->brandlogo->saveAs('img/uploads/companylogo/'.$imageName.'.'.$model->brandlogo->extension);
    //             $model->company_logo = 'img/uploads/companylogo/'.$imageName.'.'.$model->brandlogo->extension;
    //         }

    //         $model->save();

    //         return $this->redirect(['view', 'id' => $model->id]);
    //     } else {
    //         return $this->render('create', [
    //             'model' => $model,
    //         ]);
    //     }
    // }     

    /**
     * Displays a single Companies model.
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
     * Creates a new Companies model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Companies();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Companies model.
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
     * Deletes an existing Companies model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    // public function actionDelete($id)
    // {
    //     if(!empty($model->company_logo))
    //     {
    //         @unlink('/' . $model->company_logo);
    //     }
    //     $this->findModel($id)->delete();

    //     return $this->redirect(['index']);
    // }

    /**
     * Finds the Companies model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Companies the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Companies::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Description
     * @return type
     */
    public function actionMultipledelete()
    {
        $pk = Yii::$app->request->post('row_id');
        $val = Companies::STATUS_BLOCKED;
        Companies::updateAll(['state' => $val], ['in', 'id', $pk]);

        return $this->redirect(['index']);

    } 

    /**
     * Description
     * @return type
     */
    public function actionMultiplerestore()
    {
        $pk = Yii::$app->request->post('row_id');
        $val = Companies::STATUS_ACTIVE;
        Companies::updateAll(['state' => $val], ['in', 'id', $pk]);

        return $this->redirect(['index']);

    } 

}
