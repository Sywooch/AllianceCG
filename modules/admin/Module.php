<?php
namespace app\modules\admin;
use yii\filters\AccessControl;
use yii\console\Application as ConsoleApplication;
use Yii;
class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\admin\controllers';
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        // 'actions'=>['index', 'create', 'update', 'view', 'delete', 'massdelete'],
                        // 'actions'=>['*'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
    public function init()
    {
        // parent::init();
        // if (Yii::$app instanceof ConsoleApplication) {
        //     $this->controllerNamespace = 'app\modules\admin\commands';
        // }
    }
    // public static function t($category, $message, $params = [], $language = null)
    // {
    //     return Yii::t('modules/admin/' . $category, $message, $params, $language);
    // }

}