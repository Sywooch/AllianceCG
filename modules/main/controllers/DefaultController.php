<?php

// namespace app\modules\main\controllers;

// use yii\web\Controller;

// class DefaultController extends Controller
// {
//     public function actionIndex()
//     {
//         return $this->render('index');
//     }
// }
namespace app\modules\main\controllers;
 
use yii\web\Controller;
use yii\filters\AccessControl;
 
class DefaultController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions'=>['error', 'index'],
                        'roles' => ['?', '@'],
                    ],               
                ],
            ],
        ];
    }

 
    public function actionIndex()
    {
        return $this->render('index');
    }
}