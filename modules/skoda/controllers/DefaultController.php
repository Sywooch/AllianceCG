<?php

namespace app\modules\skoda\controllers;

use yii\web\Controller;
use Yii;
use app\modules\skoda\models\MonitorSearch;

/**
 * Default controller for the `skoda` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {

        return $this->render('index');     
    }
}
