<?php

namespace app\modules\alliance\models;
use yii\behaviors\TimestampBehavior;

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
        return '{{%calendar_responsibles}}';
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
                'value' => function() { return date('U'); },
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['calendar_id'], 'required'],
            [['calendar_id', 'created_at', 'updated_at'], 'integer'],
            [['calendar_id', 'created_at', 'updated_at', 'responsible_id'], 'safe'],
            [['calendar_id'], 'exist', 'skipOnError' => true, 'targetClass' => Creditcalendar::className(), 'targetAttribute' => ['calendar_id' => 'id']],
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
            'responsible_id' => Yii::t('app', 'Responsible'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreditcalendar()
    {
        return $this->hasOne(Creditcalendar::className(), ['id' => 'calendar_id']);
    }
}
