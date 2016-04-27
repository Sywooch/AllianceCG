<?php

namespace app\modules\alliance\models;

use Yii;
use yii\helpers\ArrayHelper;
use app\modules\admin\models\User;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%calendar}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $date_from
 * @property string $time_from
 * @property string $date_to
 * @property string $time_to
 * @property string $description
 * @property string $location
 * @property integer $type
 * @property integer $allday
 * @property string $author
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $status
 * @property integer $private
 * @property integer $calendar_type
 *
 * @property CalendarComments[] $calendarComments
 * @property CalendarResponsibles[] $calendarResponsibles
 */
class Creditcalendar extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%calendar}}';
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
            [['date_from', 'time_from', 'date_to', 'time_to'], 'safe'],
            ['userids', 'safe'],
            [['description'], 'string'],
            [['type', 'allday', 'created_at', 'updated_at', 'status', 'private', 'calendar_type'], 'integer'],
//            [['created_at', 'updated_at'], 'required'],
            [['title', 'location', 'author'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'date_from' => Yii::t('app', 'Date From'),
            'time_from' => Yii::t('app', 'Time From'),
            'date_to' => Yii::t('app', 'Date To'),
            'time_to' => Yii::t('app', 'Time To'),
            'description' => Yii::t('app', 'Description'),
            'location' => Yii::t('app', 'Location'),
            'type' => Yii::t('app', 'Type'),
            'allday' => Yii::t('app', 'Allday'),
            'author' => Yii::t('app', 'Author'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'status' => Yii::t('app', 'Status'),
            'private' => Yii::t('app', 'Private'),
            'calendar_type' => Yii::t('app', 'Calendar Type'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCalendarComments()
    {
        return $this->hasMany(CalendarComments::className(), ['calendar_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCalendarResponsibles()
    {
        return $this->hasMany(CalendarResponsibles::className(), ['calendar_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['id' => 'user_id'])->viaTable('{{%calendar_responsibles}}', ['calendar_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return \app\modules\alliance\models\query\CalendarQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\modules\alliance\models\query\CalendarQuery(get_called_class());
    }

    // Write to relation model

    private $userids;

    /**
     * @return array
     */
    public function getUserids()
    {
        return ArrayHelper::getColumn(
            $this->getCalendarResponsibles()->all(), 'calendar_id'
        );
    }

    /**
     * @param $value
     */
    public function setUserids($value)
    {
        $this->userids = (array)$value;
    }

    /**
     * @inheritdoc
     */
    public function afterSave($insert, $changedAttributes)
    {
        CalendarResponsibles::deleteAll(['calendar_id' => $this->id]);
        $values = [];
        foreach ($this->userids as $id) {
            $values[] = [$this->id, $id];
        }
        self::getDb()->createCommand()
            ->batchInsert(CalendarResponsibles::tableName(), ['calendar_id', 'user_id'], $values)->execute();

        parent::afterSave($insert, $changedAttributes);
    }

}
