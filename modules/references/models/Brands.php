<?php

namespace app\modules\references\models;
use app\modules\references\Module;
use yii\helpers\ArrayHelper;

use Yii;

/**
 * This is the model class for table "{{%brands}}".
 *
 * @property integer $id
 * @property string $brand
 * @property integer $state
 */
class Brands extends \yii\db\ActiveRecord
{

    const STATUS_BLOCKED = 1;
    const STATUS_ACTIVE = 0;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%brands}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['state'], 'integer'],
            [['brand'], 'string', 'max' => 255],
            [['brand', 'brand_logo', 'description'], 'safe'],
        ];
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
    public function attributeLabels()
    {
        return [
            'id' => Module::t('module', 'ID'),
            'brand' => Module::t('module', 'BRAND'),
            'brand_logo' => Module::t('module', 'BRAND_LOGO'),
            'description' => Module::t('module', 'DESCRIPTION'),
            'state' => Module::t('module', 'STATE'),            
            'globalSearch' => Module::t('module', 'SEARCH'),

        ];
    }
}
