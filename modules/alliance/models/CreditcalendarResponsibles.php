<?php

namespace app\modules\alliance\models;

use Yii;

/**
 * This is the model class for table "{{%creditcalendar_responsibles}}".
 *
 * @property integer $id
 * @property integer $creditcalendar_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Creditcalendar $creditcalendar
 */
class CreditcalendarResponsibles extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%creditcalendar_responsibles}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['creditcalendar_id'], 'required'],
            [['creditcalendar_id', 'created_at', 'updated_at'], 'integer'],
            [['creditcalendar_id'], 'exist', 'skipOnError' => true, 'targetClass' => Creditcalendar::className(), 'targetAttribute' => ['creditcalendar_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'creditcalendar_id' => Yii::t('app', 'Creditcalendar ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreditcalendar()
    {
        return $this->hasOne(Creditcalendar::className(), ['id' => 'creditcalendar_id']);
    }
}
