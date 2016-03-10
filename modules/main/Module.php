<?php

namespace app\modules\main;

use yii\console\Application as ConsoleApplication;
use yii\filters\AccessControl;
use Yii;
use yii\web\ForbiddenHttpException;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\main\controllers';
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),                
                'only' => ['index', 'contact', 'error'],
                'rules' => [
                    [
                        'actions'=>['contact'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions'=>['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }    

    public function init()
    {
        parent::init();
        if (Yii::$app instanceof ConsoleApplication) {
            $this->controllerNamespace = 'app\modules\main\commands';
        }
    }

    public static function t($category, $message, $params = [], $language = null)
    {
        return Yii::t('modules/main/' . $category, $message, $params, $language);
    }

}
