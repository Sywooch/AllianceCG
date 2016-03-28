<?php

namespace app\modules\skoda\controllers;

use yii\web\Controller;
use Yii;
use app\modules\skoda\models\MonitorSearch;
use yii\filters\AccessControl;
use app\modules\skoda\models\Servicesheduler;
use app\modules\skoda\models\DefaultSearch;
use app\modules\skoda\Module;

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
        return $this->render('index');     
    } 
}
