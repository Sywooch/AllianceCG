<?php
namespace app\modules\references;
use yii\base\BootstrapInterface;
use Yii;
class Bootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $app->i18n->translations['modules/references/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'forceTranslation' => true,
            'basePath' => '@app/modules/references/messages',
            'fileMap' => [
                'modules/references/module' => 'module.php',
            ],
        ];
    }
}