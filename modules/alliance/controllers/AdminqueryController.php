<?php

namespace app\modules\admin\controllers;
use app\modules\admin\models\AdminquerySearch;

class AdminqueryController extends \yii\web\Controller
{
    public function actionCompanyusercount()
    {
        $this->layout = false;
        $model = new AdminquerySearch();
        return $this->render('companyusercount', [
            'model' => $model,
        ]);
    }
    
    public function actionUserscreated()
    {
        $this->layout = false;
        $model = new AdminquerySearch();
        return $this->render('userscreated', [
            'model' => $model,
        ]);
    }

}
