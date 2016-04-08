<?php

namespace app\modules\alliance;

use yii\console\Application as ConsoleApplication;
use yii\filters\AccessControl;
use Yii;
use yii\web\ForbiddenHttpException;

/**
 * alliance module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\alliance\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        if (Yii::$app instanceof ConsoleApplication) {
            $this->controllerNamespace = 'app\modules\alliance\commands';
        }

        // custom initialization code goes here
    }

    public static function t($category, $message, $params = [], $language = null)
    {
        return Yii::t('modules/alliance/' . $category, $message, $params, $language);
    }
}
