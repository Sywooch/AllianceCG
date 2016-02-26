<?php

namespace app\modules\status;
use yii\filters\AccessControl;
use yii\console\Application as ConsoleApplication;
use Yii;

/**
 * status module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\status\controllers';
    // public function behaviors()
    // {
        // return [
        //     'access' => [
        //         'class' => AccessControl::className(),
        //         'rules' => [
        //             [
        //                 'allow' => true,
        //                 'roles' => ['*'],
        //             ],
        //         ],
        //     ],
        // ];
    // }
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        if (Yii::$app instanceof ConsoleApplication) {
            $this->controllerNamespace = 'app\modules\status\commands';
        }
    }
    public static function t($category, $message, $params = [], $language = null)
    {
        return Yii::t('modules/status/' . $category, $message, $params, $language);
    }    
}
