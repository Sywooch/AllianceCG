<?php

namespace app\modules\references\models;

use Yii;
use app\modules\references\Module;

/**
 * This is the model class for table "{{%targets}}".
 *
 * @property integer $id
 * @property string $target
 */
class Targets extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%targets}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['target'], 'string', 'max' => 255],
            [['target'], 'safe'],
            [['target'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'target' => Module::t('module', 'TARGET'),
            'globalSearch' => Module::t('module', 'SEARCH'),
        ];
    }
}
