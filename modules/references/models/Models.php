<?php

namespace app\modules\references\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
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
            'id' => Yii::t('app', 'ID'),
            'brand_id' => Yii::t('app', 'BRAND_ID'),
            'brand' => Yii::t('app', 'BRAND_ID'),
            'model_name' => Yii::t('app', 'MODEL_NAME'),
            'body_type' => Yii::t('app', 'BODY_TYPE'),
            'bodytype' => Yii::t('app', 'BODY_TYPE'),
            'globalSearch' => Yii::t('app', 'SEARCH'),
            'state' => Yii::t('app', 'STATE'),
            'fullmodelname' => Yii::t('app', 'MODEL_NAME'),
            'models' => Yii::t('app', 'MODELS'),
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

    public function getBrandslink()
    {
        $link = isset($this->brand->brand) ? Html::a($this->brand->brand, ['/references/brands/view', 'id' => $this->brand->id]) : false;
        return $link;
    }

    public function getBodytypeslink()
    {
        $link = isset($this->bodytype->body_type) ? Html::a($this->bodytype->body_type, ['/references/brands/view', 'id' => $this->bodytype->id]) : false;
        return $link;
    }
}
