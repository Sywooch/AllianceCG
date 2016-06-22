<?php

namespace app\modules\main\controllers;

use Yii;
use app\modules\main\models\Summertable;
use app\modules\main\models\SummertableSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\widgets\ActiveForm;

/**
 * SummertableController implements the CRUD actions for Summertable model.
 */
class SummertableController extends Controller
{

public $layout= '@app/modules/main/views/layouts/wwwhelpers';

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
     * Lists all Summertable models.
     * @return mixed
     */
    public function actionIndex()
    {        
        $searchModel = new SummertableSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Summertable model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Displays a single Summertable model.
     * @param integer $id
     * @return mixed
     */
    public function actionTestdriverequest($id)
    {
        $model = $this->findModel($id);

        $model->selectedcar = $model->model;


        if ($model->load(Yii::$app->request->post()) && $model->contact("maxim.ishchenko@gmail.com")) {
            Yii::$app->session->setFlash('contactFormSubmitted');
            echo 1;
            // return $this->refresh();
            // return $this->redirect('index');
        } else {
            return $this->renderAjax('testdriverequest', [
                // 'model' => $this->findModel($id),
                'model' => $model,
            ]);
        }
    }

    /**
     * Creates a new Summertable model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Summertable();

        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            // return $this->redirect(['view', 'id' => $model->id]);
            // return $this->redirect('index');
            if($model->save())
            {
                echo 1;
            }
            else
            {
                echo 0;
            }
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Summertable model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            // return $this->redirect(['view', 'id' => $model->id]);
            // return $this->redirect('index');
            if($model->save())
            {
                echo 1;
            }
            else
            {
                echo 0;
            }
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Summertable model.
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
     * Finds the Summertable model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Summertable the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Summertable::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionValidation()
    {
        $model = new Summertable();
        if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post()))
        {
            Yii::$app->response->format = 'json';
            return ActiveForm::validate($model);
        }
    }

}
