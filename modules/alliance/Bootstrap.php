<?php

namespace app\modules\alliance;
 
use yii\base\BootstrapInterface;
use Yii;
 
class Bootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $app->i18n->translations['modules/alliance/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'forceTranslation' => true,
            'basePath' => '@app/modules/alliance/messages',
            'fileMap' => [
                'modules/alliance/module' => 'module.php',
            ],
        ];
    }
}