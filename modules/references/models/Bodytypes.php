<?php

namespace app\modules\references\models;

use Yii;
use app\modules\references\Module;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%bodytypes}}".
 *
 * @property integer $id
 * @property string $body_type
 * @property string $description
 */
class Bodytypes extends \yii\db\ActiveRecord
{


    const STATUS_BLOCKED = 1;
    const STATUS_ACTIVE = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%bodytypes}}';
    }

    public function getStatesName()
    {
        return ArrayHelper::getValue(self::getStatesArray(), $this->state);
    }

    public static function getStatesArray()
    {
        return [
            self::STATUS_ACTIVE => 'Активен',
            self::STATUS_BLOCKED => 'Заблокирован',
        ];
    }    

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['body_type'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Module::t('module', 'ID'),
            'body_type' => Module::t('module', 'BODY_TYPE'),
            'description' => Module::t('module', 'BODY_DESCRIPTION'),
            'globalSearch' => Module::t('module', 'SEARCH'),
        ];
    }
}
