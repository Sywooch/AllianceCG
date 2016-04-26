<?php

namespace app\modules\alliance\controllers;
use app\modules\alliance\models\CreditcalendarquerySearch;

class CreditcalendargraphController extends \yii\web\Controller
{
    public function actionTotalbystatus()
    {
        $this->layout = false;
        $model = new CreditcalendarquerySearch();
        return $this->render('_totalbystatus', [
            'model' => $model,
        ]);
    }

    public function actionCreatestats()
    {
        $this->layout = false;
        $model = new CreditcalendarquerySearch();
        return $this->render('_createstats', [
            'model' => $model,
        ]);
    }

    public function actionLocations()
    {
        $this->layout = false;
        $model = new CreditcalendarquerySearch();
        return $this->render('_locations', [
            'model' => $model,
        ]);
    }
}