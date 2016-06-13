<?php

namespace app\modules\alliance\models;

use app\modules\references\models\Companies;
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
            ['private', 'default', 'value' => 0],
            [['type', 'allday', 'created_at', 'updated_at', 'status', 'private', 'calendar_type', 'priority'], 'integer'],
            [['title'], 'string', 'max' => 255],
            ['author', 'integer'],
            [['date_from', 'time_from', 'date_to', 'time_to', 'title', 'description', 'status', 'priority'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'CALENDAR_TITLE'),
            'date_from' => Yii::t('app', 'DATE_FROM'),
            'time_from' => Yii::t('app', 'TIME_FROM'),
            'date_to' => Yii::t('app', 'DATE_TO'),
            'time_to' => Yii::t('app', 'TIME_TO'),
            'description' => Yii::t('app', 'CALENDAR_DESCRIPTION'),
            'location' => Yii::t('app', 'CALENDAR_LOCATION'),
            'type' => Yii::t('app', 'CALENDAR_TYPE'),
            'allday' => Yii::t('app', 'CREDITCALENDAR_ALLDAY'),
            'priority' => Yii::t('app', 'CREDITCALENDAR_PRIORITY'),
            'author' => Yii::t('app', 'CREDITCALENDAR_AUTHOR'),
            'created_at' => Yii::t('app', 'CREATED_AT'),
            'updated_at' => Yii::t('app', 'UPDATED_AT'),
            'status' => Yii::t('app', 'CREDITCALENADR_STATUS'),
            'private' => Yii::t('app', 'Private'),
            'calendar_type' => Yii::t('app', 'Calendar Type'),
            'period' => Yii::t('app', 'CALENDAR_EVENT_PERIOD'),
            'locations' => Yii::t('app', 'CALENDAR_EVENT_LOCATIONS'),
            'responsibles' => Yii::t('app', 'CALENDAR_EVENT_RESPONSIBLES'),
            'userids' => Yii::t('app', 'CALENDAR_EVENT_RESPONSIBLES'),
            'locationids' => Yii::t('app', 'CALENDAR_EVENT_LOCATIONS'),
            'calendarcommentscount' => Yii::t('app', 'CALENDAR_COMMENTS_COUNT'),
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

        // $dateTimeFrom = \Yii::$app->formatter->asDatetime($this->date_from . ' ' . $this->time_from, "php:Y/m/d H:i");
        // $dateTimeTo = \Yii::$app->formatter->asDatetime($this->date_to . ' ' . $this->time_to, "php:Y/m/d H:i");

        $dateTimeFrom = \Yii::$app->formatter->asDatetime($this->date_from . ' ' . $this->time_from, "php:d/m/Y H:i");
        $dateTimeTo = \Yii::$app->formatter->asDatetime($this->date_to . ' ' . $this->time_to, "php:d/m/Y H:i");
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

    public function getCalendarcommentscount()
    {
        // Customer has_many Order via Order.customer_id -> id
        return $this->hasMany(CalendarComments::className(), ['calendar_id' => 'id'])->count();
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


    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if (!empty($this->allday) && $this->allday == 1) {
                $this->date_from = '';
                $this->date_to = '';

            }
            else {
                return parent::beforeSave($insert);
            }
            return true;
        }
        return false;
    }       

    /**
     * @inheritdoc
     */
    public function afterSave($insert, $changedAttributes)
    {
        if(isset($this->userids) && !empty(array_filter($this->userids))) {
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
            // Yii::$app->mailer->compose()
            // Yii::$app->mail->compose(['html' => '@app/mail-templates/html-email-01', 'text' => '@app/mail-templates/mail'], [/*Some params for the view */])
            // $model = new Creditcalendar;
            Yii::$app->mailer->compose(['html' => '@app/modules/alliance/mails/creditcalendar/newCreditCalendarEvent'], [
                    'id' => $this->id,
                    'title' => $this->title,
                    'dateTimeFrom' => $this->date_from . ' ' . $this->time_from,
                    'dateTimeTo' => $this->date_to . ' ' . $this->time_to,
                    'description' => $this->description,
                    'priority' => $this->priority,
                    'author' => $this->author,
                ])
                ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name])
                ->setReplyTo(Yii::$app->params['supportEmail'])
                ->setSubject(date('d/m/Y H:i:s') . '. ' . Yii::t('app', 'NEW_CREDITCALENDAR_EVENT') . ' ' . $this->title)
                ->setTextBody($this->description)
                ->setTo($mail)
                ->send();
        }

        if(isset($this->locationids) && !empty(array_filter($this->locationids))) {
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
