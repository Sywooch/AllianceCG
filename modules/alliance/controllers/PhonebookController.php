<?php

namespace app\modules\alliance\controllers;
use Yii;
use app\modules\alliance\models\PhonebookSearch;
use yii\web\Controller;

/**
 * Phonebook controller for the `alliance` module
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
        $dataProvider = $model->search();
        
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }
}
