<?php

namespace app\modules\alliance\controllers;

use Yii;
use app\modules\alliance\models\ClientCirculation;
use app\modules\alliance\models\ClientCirculationSearch;
use app\modules\alliance\models\Clientcirculationcomment;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ClientcirculationController implements the CRUD actions for ClientCirculation model.
 */
class ClientcirculationController extends Controller
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
     * Lists all ClientCirculation models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ClientCirculationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ClientCirculation model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $commentModel = new Clientcirculationcomment();

        return $this->render('view', [
            'model' => $model,
            'commentModel' => $commentModel,
        ]);
    }

    /**
     * Creates a new ClientCirculation model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ClientCirculation();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ClientCirculation model.
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
     * Deletes an existing ClientCirculation model.
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
     * Finds the ClientCirculation model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ClientCirculation the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ClientCirculation::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionAddevent($id)
    {
        $model = $this->findModel($id);
        $commentModel = new Clientcirculationcomment();

        if ($commentModel->load(Yii::$app->request->post())) {

            $commentModel->clientcirculation_id = $model->id;
            $commentModel->author = Yii::$app->user->getId();
            $commentModel->sales_manager_id = $commentModel->sales_manager_id;
            $commentModel->credit_manager_id = $commentModel->credit_manager_id;
            $commentModel->save();

            if($model->hasErrors() || $commentModel->hasErrors()) {
                Yii::$app->session->setFlash('err', "Errors!");
                return $this->redirect(['view', 'id' => $model->id]);
            }
            else {
                Yii::$app->session->setFlash('ok', "All Right!!");
                return $this->redirect(['view', 'id' => $model->id]);
            }            

        } else {
            return $this->renderAjax('comment', [
                'model' => $model,
                'commentModel' => $commentModel,
            ]);
            
        }

    }

    /**
     * Description
     * @return type
     */
    public function actionMultipledelete()
    {
        $pk = Yii::$app->request->post('row_id');
        $val = ClientCirculation::STATUS_BLOCKED;
        ClientCirculation::updateAll(['state' => $val], ['in', 'id', $pk]);

        return $this->redirect(['index']);

    } 

    /**
     * Description
     * @return type
     */
    public function actionMultiplerestore()
    {
        $pk = Yii::$app->request->post('row_id');
        $val = ClientCirculation::STATUS_ACTIVE;
        ClientCirculation::updateAll(['state' => $val], ['in', 'id', $pk]);

        return $this->redirect(['index']);

    }   
}
