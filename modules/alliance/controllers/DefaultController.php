<?php

namespace app\modules\alliance\controllers;

use yii\web\Controller;
use app\modules\alliance\models\AllianceDefault;

/**
 * Default controller for the `alliance` module
 */
class DefaultController extends Controller
{
    // public $layout = '@app/modules/alliance/views/layouts/default/main';
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
}
