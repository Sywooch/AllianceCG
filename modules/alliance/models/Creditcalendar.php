<?php

namespace app\modules\alliance\models;

use app\modules\admin\models\Companies;
use Yii;
use yii\helpers\ArrayHelper;
use app\modules\admin\models\User;
use yii\behaviors\TimestampBehavior;
use app\modules\alliance\Module;

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
    const STATUS_ATWORK = 0;
    const STATUS_CLARIFY = 1;
    const STATUS_FINISHED = 2;

    const PRIORITY_BASIC = 0;
    const PRIORITY_HIGH = 1;
    const PRIORITY_LOW = 2;

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
            [['date_from', 'time_from', 'date_to', 'time_to', 'priority'], 'safe'],
            ['userids', 'safe'],
            ['locationids', 'safe'],
            [['description'], 'string'],
            ['author', 'default', 'value' => Yii::$app->user->getId()],
            [['type', 'allday', 'created_at', 'updated_at', 'status', 'private', 'calendar_type', 'priority'], 'integer'],
//            [['created_at', 'updated_at'], 'required'],
            [['title'], 'string', 'max' => 255],
            ['author', 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Module::t('module', 'ID'),
            'title' => Module::t('module', 'CALENDAR_TITLE'),
            'date_from' => Module::t('module', 'DATE_FROM'),
            'time_from' => Module::t('module', 'Time From'),
            'date_to' => Module::t('module', 'DATE_TO'),
            'time_to' => Module::t('module', 'Time To'),
            'description' => Module::t('module', 'CALENDAR_DESCRIPTION'),
            'location' => Module::t('module', 'CALENDAR_LOCATION'),
            'type' => Module::t('module', 'CALENDAR_TYPE'),
            'allday' => Module::t('module', 'CREDITCALENDAR_ALLDAY'),
            'priority' => Module::t('module', 'CREDITCALENDAR_PRIORITY'),
            'author' => Module::t('module', 'CREDITCALENDAR_AUTHOR'),
            'created_at' => Module::t('module', 'CREATED_AT'),
            'updated_at' => Module::t('module', 'UPDATED_AT'),
            'status' => Module::t('module', 'CREDITCALENADR_STATUS'),
            'private' => Module::t('module', 'Private'),
            'calendar_type' => Module::t('module', 'Calendar Type'),
            'period' => Module::t('module', 'CALENDAR_EVENT_PERIOD'),
            'locations' => Module::t('module', 'CALENDAR_EVENT_LOCATIONS'),
            'responsibles' => Module::t('module', 'CALENDAR_EVENT_RESPONSIBLES'),
            'userids' => Module::t('module', 'CALENDAR_EVENT_RESPONSIBLES'),
            'locationids' => Module::t('module', 'CALENDAR_EVENT_LOCATIONS'),
        ];
    }


    /**
     * @return mixed
     */
    public function getStatuses()
    {
        return ArrayHelper::getValue(self::getStatusesArray(), $this->status);
    }

    /**
     * @return mixed
     */
    public function getPriorities()
    {
        return ArrayHelper::getValue(self::getPrioritiesArray(), $this->priority);
    }

    public function getPrioritiesArray()
    {
        return[
            self::PRIORITY_BASIC => 'Обычная',
            self::PRIORITY_HIGH => 'Высокая',
            self::PRIORITY_LOW => 'Низкая',
        ];
    }

    /**
     * @return array
     */
    public function getStatusesArray()
    {
        return[
            self::STATUS_ATWORK => 'В работе',
            self::STATUS_CLARIFY => 'Уточнение',
            self::STATUS_FINISHED => 'Завершено',
        ];
    }

    /**
     * @return string
     */
    public function getPeriod()
    {

        $dateTimeFrom = \Yii::$app->formatter->asDatetime($this->date_from . ' ' . $this->time_from, "php:Y/m/d H:i");
        $dateTimeTo = \Yii::$app->formatter->asDatetime($this->date_to . ' ' . $this->time_to, "php:Y/m/d H:i");
        $period = $dateTimeFrom . ' - ' . $dateTimeTo;
        return $period;
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
    public function getCalendarLocations()
    {
        return $this->hasMany(CalendarLocations::className(), ['calendar_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthorname()
    {
        return $this->hasOne(User::className(), ['id' => 'author']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['id' => 'user_id'])->viaTable('{{%calendar_responsibles}}', ['calendar_id' => 'id']);
    }



    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCommentAuthors()
    {
        return $this->hasMany(User::className(), ['id' => 'user_id'])->viaTable('{{%calendar_comments}}', ['calendar_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocations()
    {
        return $this->hasMany(Companies::className(), ['id' => 'company_id'])->viaTable('{{%calendar_locations}}', ['calendar_id' => 'id']);
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
    private $locationids;

    /**
     * @return array
     */
    public function getUserids()
    {
        return ArrayHelper::getColumn(
            $this->getCalendarResponsibles()->all(), 'user_id'
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
     * @return array
     */
    public function getLocationids()
    {
        return ArrayHelper::getColumn(
            $this->getCalendarLocations()->all(), 'company_id'
        );
    }

    /**
     * @param $value
     */
    public function setLocationids($value)
    {
        $this->locationids = (array)$value;
    }

    /**
     * @inheritdoc
     */
    public function afterSave($insert, $changedAttributes)
    {
        if(!empty(array_filter($this->userids))) {
            CalendarResponsibles::deleteAll(['calendar_id' => $this->id]);
            $values = [];
            foreach ($this->userids as $id) {
                $values[] = [$this->id, $id];
            }

            self::getDb()->createCommand()
                ->batchInsert(CalendarResponsibles::tableName(), ['calendar_id', 'user_id'], $values)->execute();

            $emails = User::find()->where(['IN', 'id', $this->userids])->all();
            foreach($emails as $email)
            {
                $mail[] = $email->email;
            }
            Yii::$app->mailer->compose()
                ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name])
                ->setReplyTo(Yii::$app->params['supportEmail'])
                ->setSubject(date('d/m/Y H:i:s') . '. ' . Module::t('module', 'NEW_CREDITCALENDAR_COMMENT_FOR') . ' ' . $this->title)
                ->setTextBody($this->description)
                ->setTo($mail)
                ->send();
        }

        if(!empty(array_filter($this->locationids))) {
            CalendarLocations::deleteAll(['calendar_id' => $this->id]);
            $values = [];
            foreach ($this->locationids as $id) {
                $values[] = [$this->id, $id];
            }

            self::getDb()->createCommand()
                ->batchInsert(CalendarLocations::tableName(), ['calendar_id', 'company_id'], $values)->execute();
        }
        parent::afterSave($insert, $changedAttributes);
    }

}
