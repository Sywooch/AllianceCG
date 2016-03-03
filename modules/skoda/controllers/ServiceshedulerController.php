<?php

namespace app\modules\skoda\controllers;

use Yii;
use app\modules\skoda\models\Servicesheduler;
use app\modules\skoda\models\ServiceshedulerSearch;
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
        $searchModel = new ServiceshedulerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $events = Servicesheduler::find()->all();

        $tasks = [];
        foreach ($events as $eve) {
            $event = new \yii2fullcalendar\models\Event();
            $event->id = $eve->id;
            $event->start = $eve->date.'T00:00:01';
            $event->end = $eve->date.'T23:59:59';
            $event->title = $eve->responsible;
            $event->backgroundColor = '#4ba82e';
            // $event->dayClick = 'http://google.com';
            $event->allDay = true;
            $tasks[] = $event;
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'events' => $tasks, 
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
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
