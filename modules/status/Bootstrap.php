<?php
namespace app\modules\status;
use yii\base\BootstrapInterface;
use Yii;
class Bootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $app->i18n->translations['modules/status/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'forceTranslation' => true,
            'basePath' => '@app/modules/status/messages',
            'fileMap' => [
                'modules/status/module' => 'module.php',
            ],
        ];
    }
}