<?php

namespace app\modules\alliance\models;

use Yii;

/**
 * This is the model class for table "{{%calendar_locations}}".
 *
 * @property integer $id
 * @property integer $calendar_id
 * @property integer $company_id
 *
 * @property Calendar $calendar
 * @property Companies $company
 */
class CalendarLocations extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%calendar_locations}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['calendar_id', 'company_id'], 'required'],
            [['calendar_id', 'company_id'], 'integer'],
            [['calendar_id'], 'exist', 'skipOnError' => true, 'targetClass' => Calendar::className(), 'targetAttribute' => ['calendar_id' => 'id']],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Companies::className(), 'targetAttribute' => ['company_id' => 'id']],
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
            'company_id' => Yii::t('app', 'Company ID'),
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
    public function getCompany()
    {
        return $this->hasOne(Companies::className(), ['id' => 'company_id']);
    }
}
