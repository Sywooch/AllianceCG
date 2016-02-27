<?php

namespace app\modules\status\controllers;

use yii\web\Controller;
use Yii;
// use app\modules\status\models\Statusmonitor;
use app\modules\status\models\StatusmonitorSearch;

/**
 * Default controller for the `status` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        // return $this->render('index');   
        $searchModel = new StatusmonitorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);     
    }
}
