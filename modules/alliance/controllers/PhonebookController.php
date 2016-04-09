<?php

namespace app\modules\alliance\controllers;

use app\modules\alliance\models\PhonebookSearch;
use yii\web\Controller;

/**
 * Default controller for the `alliance` module
 */
class PhonebookController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $model = new PhonebookSearch();
        return $this->render('index', [
            'model' => $model,
        ]);
    }
}
