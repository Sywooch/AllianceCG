<?php

namespace app\modules\references\models;

use Yii;
use app\modules\references\Module;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
use app\modules\admin\models\User;

/**
 * This is the model class for table "{{%models}}".
 *
 * @property integer $id
 * @property integer $brand_id
 * @property string $model_name
 * @property string $body_type
 *
 * @property Brands $brand
 */
class Models extends \yii\db\ActiveRecord
{

    const STATUS_BLOCKED = 1;
    const STATUS_ACTIVE = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%models}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => function () {
                    return date('U');
                },
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['brand_id', 'model_name', 'body_type'], 'required'],
            [['brand_id'], 'integer'],
            [['model_name', 'body_type'], 'string', 'max' => 255],
            [['brand_id'], 'exist', 'skipOnError' => true, 'targetClass' => Brands::className(), 'targetAttribute' => ['brand_id' => 'id']],
            ['author', 'default', 'value' => Yii::$app->user->getId()],
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
            'brand_id' => Module::t('module', 'BRAND_ID'),
            'model_name' => Module::t('module', 'MODEL_NAME'),
            'body_type' => Module::t('module', 'BODY_TYPE'),
            'globalSearch' => Module::t('module', 'SEARCH'),
            'state' => Module::t('module', 'STATE'),
            'fullmodelname' => Module::t('module', 'MODEL_NAME'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBrand()
    {
        return $this->hasOne(Brands::className(), ['id' => 'brand_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBodytype()
    {
        return $this->hasOne(Bodytypes::className(), ['id' => 'body_type']);
    }

    /**
     * 
     */
    public function getFullmodelname()
    {
        return $this->brand->brand . ' ' . $this->model_name . ' ' . $this->bodytype->body_type;
    }
}
