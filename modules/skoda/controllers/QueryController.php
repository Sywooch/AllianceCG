<?php

namespace app\modules\skoda\controllers;
use app\modules\skoda\models\DefaultSearch;

class QueryController extends \yii\web\Controller
{
    public function actionWorkerloadgraph()
    {    
        $this->layout = false;    
        $model = new DefaultSearch();
        return $this->render('workerloadgraph', [
            'model' => $model,
        ]);
    }

}
