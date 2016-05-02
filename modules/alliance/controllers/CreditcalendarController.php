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
}
