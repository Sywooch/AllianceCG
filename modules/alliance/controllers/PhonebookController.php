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
        $this->layout = false;
        $ldap = Yii::$app->ldap->ldapquery();
        $model = new PhonebookSearch();
        $searchModel = new PhonebookSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'ldap' => $ldap,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }
}
