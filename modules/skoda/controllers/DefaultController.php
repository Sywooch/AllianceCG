<?php

namespace app\modules\skoda\controllers;

use yii\web\Controller;
use Yii;
use app\modules\skoda\models\MonitorSearch;
use yii\filters\AccessControl;
use app\modules\skoda\models\Servicesheduler;

/**
 * Default controller for the `skoda` module
 */
class DefaultController extends Controller
{

    public $layout = '@app/modules/skoda/views/layouts/default/main';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['?', '@'],
                    ],
                ],
            ],
        ];        
    }      

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {

        $today = Yii::$app->formatter->asDate('now', 'yyyy-MM-dd');
        $wcs = Servicesheduler::find()
            ->where(['date' => $today])
            ->one();
    
        if(empty($wcs->responsible))                
        {
            \Yii::$app->getSession()->setFlash('danger', Yii::t('app', 'MASTER_CONSULTANT_DOES_NOT_EXIST_TODAY'));
        }
        else
        {
            \Yii::$app->getSession()->setFlash('success', Yii::$app->formatter->asDate($wcs->date, 'dd/MM/yyyy') . ' - ' . Yii::t('app', 'CURRENT_MASTER_CONSULTANT') .' - '. $wcs->responsible);
        }   
        return $this->render('index');     
    }
}
