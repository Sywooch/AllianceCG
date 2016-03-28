<?php

namespace app\modules\skoda\controllers;
use app\modules\skoda\models\SkodaquerySearch;

class SkodaqueryController extends \yii\web\Controller
{
    public function actionWorkerloadgraph()
    {
        $this->layout = false;
        $model = new SkodaquerySearch();
        return $this->render('workerloadgraph', [
            'model' => $model,
        ]);
    }
    
    public function actionStatusmonitorgraph()
    {
        $this->layout = false;
        $model = new SkodaquerySearch();
        return $this->render('statusmonitorgraph', [
            'model' => $model,
        ]);
    }

}
