<?php

namespace app\modules\alliance\models;

use Yii;
use app\modules\admin\models\User;

/**
 * This is the model class for table "{{%calendar_responsibles}}".
 *
 * @property integer $id
 * @property integer $calendar_id
 * @property integer $user_id
 *
 * @property Calendar $calendar
 * @property User $user
 */
class CalendarResponsibles extends \yii\db\ActiveRecord
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
//            [['calendar_id', 'user_id'], 'required'],
//            [['calendar_id', 'user_id'], 'integer'],
//            [['calendar_id'], 'exist', 'skipOnError' => true, 'targetClass' => Creditcalendar::className(), 'targetAttribute' => ['calendar_id' => 'id']],
//            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'calendar_id' => Yii::t('app', 'Calendar ID'),
            'user_id' => Yii::t('app', 'User ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCalendar()
    {
        return $this->hasOne(Calendar::className(), ['id' => 'calendar_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
