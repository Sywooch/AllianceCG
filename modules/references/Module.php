<?php

namespace app\modules\references;
use yii\filters\AccessControl;
use yii\console\Application as ConsoleApplication;
use Yii;

/**
 * references module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\references\controllers';
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

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        // if (Yii::$app instanceof ConsoleApplication) {
        //     $this->controllerNamespace = 'app\modules\references\commands';
        // }

        // custom initialization code goes here
    }
    // public static function t($category, $message, $params = [], $language = null)
    // {
    //     return Yii::t('modules/references/' . $category, $message, $params, $language);
    // }
}
