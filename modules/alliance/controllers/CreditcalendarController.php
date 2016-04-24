<?php

namespace app\modules\alliance\controllers;

use Yii;
use app\modules\alliance\models\Creditcalendar;
use app\modules\alliance\models\CreditcalendarSearch;
use app\modules\alliance\models\CreditcalendarComments;
use app\modules\alliance\models\CreditcalendarResponsibles;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;
use yii\web\HttpException;
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
        $model = $this->findModel($id);
                
        if ($model->load(Yii::$app->request->post()) && $model->save())
        {
            // $model->scenario = Creditcalendar::SCENARIO_COMMENT;
            $creditcalendarComments = new Creditcalendarcomments();
            $creditcalendarComments->creditcalendar_id = $model->id;
            $creditcalendarComments->comment_text = $model->comment_text;
            $creditcalendarComments->comment_author = Yii::$app->user->getId();
            $creditcalendarComments->save();
            $model = new Creditcalendar();
        }        
        
        $dataProvider = new ActiveDataProvider([
            'query' => CreditcalendarComments::find()->where(['creditcalendar_id' => $model->id])->orderBy('id ASC'),
            'pagination' => false,
        ]);
        
        
        if($model->is_chief_task == 1 && !Yii::$app->user->can('chiefcredit'))
        {
            throw new HttpException(403, Module::t('module', 'ONLY_CHIEFCREDIT_CAN_DO_THERE'));
        }
        else
        {
            return $this->render('view', [
                'model' => $model,
                'listDataProvider' => $dataProvider,
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
        if (!Yii::$app->user->can('createCreditcalendarPost')) {
            throw new ForbiddenHttpException('Access denied');
        }
        else
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

            if ($model->load(Yii::$app->request->post())) {
                if(!empty($model->dow)){
                    $model->dow = implode(',',$model->dow);
                }
                $model->save();

                if($model->responsible){
                    foreach ($model->responsible as $responsibles) {
                        $creditcalendarResponsibles = new CreditcalendarResponsibles();
                        $creditcalendarResponsibles->creditcalendar_id = $model->id;
                        $creditcalendarResponsibles->responsible = $responsibles;
                        $creditcalendarResponsibles->save();
                    } 

                    Yii::$app->mailer->compose()
                        ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name])
                        ->setReplyTo(Yii::$app->params['supportEmail'])
                        ->setSubject(date('d/m/Y H:i:s') . '. ' . Module::t('module', 'CREDITCALENDAR_NEW_TASK'))
                        ->setTextBody($model->description)
                        ->setTo($model->getResponsibleemails())
                        ->send();
                }

                return $this->redirect(['view', 'id' => $model->id]);
            } 
            else 
            {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
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
        $model->dow = explode(',',  $model->dow);

        if (!Yii::$app->user->can('updateCreditcalendarPost', ['creditcalendar' => $model])) {
            throw new ForbiddenHttpException(Module::t('module', 'ONLY_AUTHOR_CAN_UPDATE_THIS_RECORD'));
        }
        else
        {  
            if ($model->load(Yii::$app->request->post())) {   
                    $model->dow = implode(',',$model->dow);
                    $model->save();
                    // if($model->save()){
                        return $this->redirect(['view', 'id' => $model->id]);                        
                    // }
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
        $headmodel = new Creditcalendar();
        $filename = 'Creditcalendar-'.Date('Y-m-d-H-i-s').'.xls';
        echo '<meta http-equiv="Content-type" content="application/vnd-ms-excel; charset=utf-8" />';
        header("Content-type: application/vnd-ms-excel; charset=utf-8");
        header("Content-Transfer-Encoding: binary");
        header("Content-Disposition: attachment; filename=".$filename);
        header('Pragma: no-cache');
        echo '<table border="1" width="100%">
            <thead>
                <tr>
                    <th>'. $headmodel->getAttributeLabel( 'title' ) .'</th>
                    <th>'. $headmodel->getAttributeLabel( 'dateTimeFrom' ) .'</th>
                    <th>'. $headmodel->getAttributeLabel( 'dateTimeTo' ) .'</th>
                    <th>'. $headmodel->getAttributeLabel( 'description' ) .'</th>
                    <th>'. $headmodel->getAttributeLabel( 'location' ) .'</th>
                    <th>'. $headmodel->getAttributeLabel( 'author' ) .'</th>
                    <th>'. $headmodel->getAttributeLabel( 'status' ) .'</th>
                    
                </tr>
            </thead>';
            foreach($model as $data){
                echo '
                    <tr>
                        <td>'.$data['title'].'</td>
                        <td>'.$data['date_from']. ' ' .$data['time_from'].'</td>
                        <td>'.$data['date_to']. ' ' .$data['time_to'].'</td>
                        <td>'.$data['description'].'</td>
                        <td>'.$data['location'].'</td>
                        <td>'.$data['author'].'</td>
                        <td>'.$data['status'].'</td>
                    </tr>
                ';
            }
        echo '</table>';

    }     
}
