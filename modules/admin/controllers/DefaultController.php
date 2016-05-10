<?php

namespace app\modules\admin\controllers;

use yii\web\Controller;

class DefaultController extends Controller
{
	// public $layout = '@app/modules/admin/views/layouts/default/main';

    public function actionIndex()
    {    	
        return $this->render('index');
    }
}
