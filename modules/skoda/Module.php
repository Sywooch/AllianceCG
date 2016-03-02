<?php

namespace app\modules\skoda;
use yii\filters\AccessControl;
use yii\console\Application as ConsoleApplication;
use Yii;

/**
 * skoda module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\skoda\controllers';
    // public function behaviors()
    // {
    //     return [
    //         'access' => [
    //             'class' => AccessControl::className(),
    //             'rules' => [
    //                 [
    //                     'allow' => true,
    //                     'actions'=>['index', 'error', 'monitor', 'dashboard'],
    //                     'roles' => ['?'],
    //                 ],
    //                 [
    //                     'allow' => true,
    //                     'actions'=>['view', 'create', 'update', 'index', 'monitor', 'dashboard'],
    //                     'roles' => ['@'],
    //                 ],                
    //             ],
    //         ],
    //     ];
    // }
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        if (Yii::$app instanceof ConsoleApplication) {
            $this->controllerNamespace = 'app\modules\skoda\commands';
        }
    }
    public static function t($category, $message, $params = [], $language = null)
    {
        return Yii::t('modules/skoda/' . $category, $message, $params, $language);
    }    
}
