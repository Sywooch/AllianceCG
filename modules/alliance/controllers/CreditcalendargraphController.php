<?php

namespace app\modules\alliance\controllers;
use app\modules\alliance\models\CreditcalendarquerySearch;

class CreditcalendargraphqueryController extends \yii\web\Controller
{
    public function actionTotalbystatus()
    {
        $this->layout = false;
        $model = new CreditcalendarquerySearch();
        return $this->render('totalbystatus', [
            'model' => $model,
        ]);
    }
    
    public function actionCreatstats()
    {
        $this->layout = false;
        $model = new CreditcalendarquerySearch();
        return $this->render('creatstats', [
            'model' => $model,
        ]);
    }

}