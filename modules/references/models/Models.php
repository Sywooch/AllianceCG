<?php

namespace app\modules\references\models;

use Yii;

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
    public function rules()
    {
        return [
            [['brand_id'], 'required'],
            [['brand_id'], 'integer'],
            [['model_name', 'body_type'], 'string', 'max' => 255],
            [['brand_id'], 'exist', 'skipOnError' => true, 'targetClass' => Brands::className(), 'targetAttribute' => ['brand_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'brand_id' => Yii::t('app', 'Brand ID'),
            'model_name' => Yii::t('app', 'Model Name'),
            'body_type' => Yii::t('app', 'Body Type'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBrand()
    {
        return $this->hasOne(Brands::className(), ['id' => 'brand_id']);
    }
}
