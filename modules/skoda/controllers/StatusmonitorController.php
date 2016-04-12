<?php
 
namespace app\modules\skoda\controllers;

use Yii;
use app\modules\skoda\models\Statusmonitor;
use app\modules\skoda\models\StatusmonitorSearch;
use app\modules\skoda\models\Servicesheduler;
use app\modules\skoda\models\MonitorSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

/**
 * StatusmonitorController implements the CRUD actions for Statusmonitor model.
 */
class StatusmonitorController extends Controller
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
            // 'access' => [
            //     'class' => AccessControl::className(),
            //     'rules' => [
            //         [
            //             'allow' => true,
            //             'actions'=>['error', 'monitor'],
            //             'roles' => ['?'],
            //         ],
            //         [
            //             'allow' => true,
            //             'actions'=>['view', 'create', 'update', 'index', 'monitor', 'dashboard'],
            //             'roles' => ['@'],
            //         ],                  
            //     ],
            // ],            
        ];
    }

    /**
     * Lists all Statusmonitor models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new Statusmonitor();
        $searchModel = new StatusmonitorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }
    
    public function actionExport(){
        $model = StatusmonitorSearch::find()->All();
        $filename = 'Statusmonitor-'.Date('Y-m-d-H-i-s').'.xls';
        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=".$filename);
        echo '<table border="1" width="100%">
            <thead>
                <tr>
                    <th>№</th>
                    <th>Начало</th>
                    <th>Окончание</th>
                </tr>
            </thead>';
            foreach($model as $data){
                echo '
                    <tr>
                        <td>'.$data['regnumber'].'</td>
                        <td>'.$data['from'].'</td>
                        <td>'.$data['to'].'</td>
                    </tr>
                ';
            }
        echo '</table>';

    }    

    public function actionCalendar()
    {

        $model = new Statusmonitor();
                
        return $this->render('calendar', [
            'model' => $model,         
            ]);
    }
    
    public function actionCalendarsearch()
    {
        $this->layout = false;
        $model = new StatusmonitorSearch();
        return $this->render('_calendarSearch', [
            'model' => $model,
        ]);
    }

    public function actionMonitor()
    {
        $this->layout = '@app/modules/skoda/views/layouts/monitor/main';
        $searchModel = new MonitorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('monitor', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);     
    }    

    /**
     * Displays a single Statusmonitor model.
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
     * Creates a new Statusmonitor model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Statusmonitor();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Statusmonitor model.
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
     * Deletes an existing Statusmonitor model.
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
     * Finds the Statusmonitor model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Statusmonitor the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Statusmonitor::findOne($id)) !== null) {
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
            $sql = "DELETE FROM sk_statusmonitor WHERE id = $value";
            $query = Yii::$app->db->createCommand($sql)->execute();
        }

        return $this->redirect(['index']);

    }    
}
