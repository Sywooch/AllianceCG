<?php

namespace app\modules\alliance\controllers;

use yii\web\Controller;
use app\modules\alliance\models\AllianceDefault;

/**
 * Default controller for the `alliance` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
    	$model = new AllianceDefault();
    	
        return $this->render('index', [
                    'model' => $model,
                ]);
    }

    /**
     * [actionCreditlastcount description]
     * @return [type] [description]
     */
    public function actionCreditlastcount()
    {
        $this->layout = false;
        $model = new AllianceDefault();
        return $this->render('creditlastcount', [
            'model' => $model,
        ]);
    }    
}
