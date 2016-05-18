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
    
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions'=>['monitor'],
                        'allow' => true,
                        'roles' => ['?', '@'],
                    ],
                    [
                        'actions'=>['index', 'create', 'view', 'update', 'calendar', 'calendarsearch', 'workerloadgraph', 'statusmonitorgraph', 'multipledelete', 'list', 'export', 'import-excel'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions'=>['delete', 'multipleDelete', 'multiplerestore'],
                        'allow' => true,
                        'roles' => ['head', 'admin', 'root'],
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
        if (Yii::$app instanceof ConsoleApplication) {
            $this->controllerNamespace = 'app\modules\skoda\commands';
        }
    }
    public static function t($category, $message, $params = [], $language = null)
    {
        return Yii::t('modules/skoda/' . $category, $message, $params, $language);
    }    
}
