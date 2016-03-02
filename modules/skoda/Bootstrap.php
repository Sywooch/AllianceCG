<?php
namespace app\modules\skoda;
use yii\base\BootstrapInterface;
use Yii;
class Bootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $app->i18n->translations['modules/skoda/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'forceTranslation' => true,
            'basePath' => '@app/modules/skoda/messages',
            'fileMap' => [
                'modules/skoda/module' => 'module.php',
            ],
        ];
    }
}