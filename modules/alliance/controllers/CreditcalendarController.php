<?php

namespace app\modules\alliance\controllers;

use Yii;
use app\modules\alliance\models\Creditcalendar;
use app\modules\alliance\models\CreditcalendarSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }    
    
    public function actionGraph()
    {    	
        $model = new Creditcalendar();
        return $this->render('graph', [
            'model' => $model,
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
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
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
        
//        $model->scenario = User::SCENARIO_ADMIN_CREATE;
        
        if(isset($_GET['is_task']))
        {
            $model->is_task = $_GET['is_task'];
            if($model->is_task == 0)
            {
                $model->scenario = Creditcalendar::SCENARIO_EVENT;
            }
            elseif($model->is_task == 1)
            {
                $model->scenario = Creditcalendar::SCENARIO_TASK;
            }
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }           
        }

//        if ($model->load(Yii::$app->request->post())){
//            $model->dow = explode(',',$model->dow);
//            if($model->save()){
//                return $this->redirect(['view', 'id' => $model->id]);
//            }
//        } 
//        else {
//            $model->dow = explode(',',$model->dow);
//            return $this->render('create', [
//                'model' => $model,
//            ]);
//        }        
        

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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
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
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
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

    public function actionMultipledelete()
    {
        $pk = Yii::$app->request->post('row_id');

        foreach ($pk as $key => $value) 
        {
            $sql = "DELETE FROM {{%creditcalendar}} WHERE id = $value";
            $query = Yii::$app->db->createCommand($sql)->execute();
        }

        return $this->redirect(['index']);
    }
    
    public function actionExport(){
        $model = Creditcalendar::find()->All();
        $filename = 'Creditcalendar-'.Date('Y-m-d-H-i-s').'.xls';
        echo '<meta http-equiv="Content-type" content="text/html; charset=utf-8" />';
        header("Content-type: application/vnd-ms-excel; charset=utf-8");
        header("Content-Transfer-Encoding: binary");
        header("Content-Disposition: attachment; filename=".$filename);
        header('Pragma: no-cache');
        echo '<table border="1" width="100%">
            <thead>
                <tr>
                    <th>Наименование</th>
                    <th>От:</th>
                    <th>До:</th>
                    <th>Описание</th>
                    <th>Месторасположение</th>
                    <th>Автор</th>
                    <th>Дата создания</th>
                    
                </tr>
            </thead>';
            foreach($model as $data){
                echo '
                    <tr>
                        <td>'.$data['title'].'</td>
                        <td>'.$data['dateTimeFrom'].'</td>
                        <td>'.$data['dateTimeTo'].'</td>
                        <td>'.$data['description'].'</td>
                        <td>'.$data['location'].'</td>
                        <td>'.$data['author'].'</td>
                        <td>'.$data['created_at'].'</td>
                    </tr>
                ';
            }
        echo '</table>';

    }     
}
