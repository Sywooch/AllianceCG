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
    public function rules()
    {
        return [
//            [['calendar_id'], 'required'],
            [['calendar_id'], 'integer'],
            [['calendar_id', 'user_id'], 'safe'],
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
            'calendar_id' => Yii::t('app', 'Creditcalendar ID'),
            'user_id' => Yii::t('app', 'Responsible'),
        ];
    }
}
