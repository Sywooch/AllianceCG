<?php

namespace app\modules\alliance\models;
use app\modules\alliance\Module;
use yii\behaviors\TimestampBehavior;
use rmrevin\yii\fontawesome\FA;
use yii\helpers\ArrayHelper;
use yii\db\Expression;

use Yii;

/**
 * This is the model class for table "{{%creditcalendar}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $date_from
 * @property string $time_from
 * @property string $date_to
 * @property string $time_to
 * @property string $description
 * @property string $location
 * @property integer $is_task
 * @property integer $is_repeat
 * @property string $author
 * @property string $allday
 * @property integer $created_at
 * @property integer $status    
 * @property integer $responsible
 */
class Creditcalendar extends \yii\db\ActiveRecord
{
    const IS_TASK_CALENDAR= 0;
    const IS_TASK_TASK = 1;
    
    const STATUS_ATWORK = 0;
    const STATUS_CLARIFY = 1;
    const STATUS_FINISHED = 2;
    
    const SCENARIO_EVENT = 'createEvent';
    const SCENARIO_TASK = 'createTask';
    
//    const DAY_MON = 1;
//    const DAY_TUE = 2;
//    const DAY_WED = 3;
//    const DAY_THU = 4;
//    const DAY_FRI = 5;
//    const DAY_SAT = 6;
//    const DAY_SUN = 7;
    
    public $dateTimeFrom;
    public $dateTimeTo;
//    public $week;
    
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%creditcalendar}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
//        return [
//            TimestampBehavior::className(),
//        ];
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
//                'value' => new Expression('NOW()'),
                'value' => function() { return date('U'); },
            ],
        ];
    }
    
    public function getStatuses()
    {
        return ArrayHelper::getValue(self::getStatusesArray(), $this->status);
    }

//    public function getWeekDays()
//    {
//        return ArrayHelper::getValue(self::getWeekdaysArray(), $this->week);
//    }
    
//    public function getWeekdaysArray()
//    {
//        return[
//            self::DAY_MON => 'Пн',
//            self::DAY_TUE => 'Вт',
//            self::DAY_WED => 'Ср',
//            self::DAY_THU => 'Чт',
//            self::DAY_FRI => 'Пт',
//            self::DAY_SAT => 'Сб',
//            self::DAY_SUN => 'Вс',
//        ];
//    }
    
    public function getStatusesArray()
    {
        return[
            self::STATUS_ATWORK => 'В работе',
            self::STATUS_CLARIFY => 'Уточнение',
            self::STATUS_FINISHED => 'Завершено',
        ];
    }
    
    public function getIsTask()
    {
        return ArrayHelper::getValue(self::getTasksArray(), $this->is_task);
    }    
 
    public static function getTasksArray()
    {
        return [
            self::IS_TASK_CALENDAR => 'Событие',
            self::IS_TASK_TASK => 'Задание',
        ];
    }
    
    public function getIsTaskIcon()
    {
        $isTaskIcon = ($this->is_task == 0) ? FA::icon('calendar') : FA::icon('tasks');
        return $isTaskIcon;
    }
    
    public function getDateTimeFrom()
    {
        return $this->date_from . ' ' . $this->time_from;
    }
    
    public function getDateTimeTo()
    {
        return $this->date_to . ' ' . $this->time_to;
    }    
    
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_EVENT] = ['date_from', 'date_to', 'time_from', 'time_to', 'allday', 'author', 'title', 'description', 'location', 'status'];
        $scenarios[self::SCENARIO_TASK] = ['date_from', 'date_to', 'time_from', 'time_to', 'allday', 'author', 'title', 'description', 'location', 'status', 'responsible'];
        return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['responsible'], 'required', 'on' => self::SCENARIO_TASK],
            ['status', 'default', 'value' => self::STATUS_ATWORK],
            ['status', 'in', 'range' => array_keys(self::getStatusesArray())],
            [['date_from', 'time_from', 'date_to', 'time_to', 'dateTimeFrom', 'dateTimeTo', 'allday'], 'safe'],
            [['description'], 'string'],
            ['author', 'default', 'value' => Yii::$app->user->identity->userfullname],
            ['is_task', 'in', 'range' => array_keys(self::getTasksArray()), 'message' => Module::t('module', 'CREDITCALENDAR_LINK_ERROR')],
//            ['week', 'in', 'range' => array_keys(self::getWeekdaysArray()), 'message' => Module::t('module', 'CREDITCALENDAR_LINK_ERROR')],
            [['is_task', 'is_repeat'], 'integer'],
            [['title', 'location', 'author'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Module::t('module', 'ID'),
            'title' => Module::t('module', 'CREDITCALENDAR_TITLE'),
            'date_from' => Module::t('module', 'CREDITCALENDAR_DATE_FROM'),
            'time_from' => Module::t('module', 'CREDITCALENDAR_TIME_FROM'),
            'date_to' => Module::t('module', 'CREDITCALENDAR_DATE_TO'),
            'time_to' => Module::t('module', 'CREDITCALENDAR_TIME_TO'),
            'description' => Module::t('module', 'CREDITCALENDAR_DESCRIPTION'),
            'location' => Module::t('module', 'CREDITCALENDAR_LOCATION'),
            'is_task' => Module::t('module', 'CREDITCALENDAR_IS_TASK'),
            'is_repeat' => Module::t('module', 'CREDITCALENDAR_IS_REPEAT'),
            'author' => Module::t('module', 'CREDITCALENDAR_AUTHOR'),
            'created_at' => Module::t('module', 'CREDITCALENDAR_CREATED_AT'),
            'status' => Module::t('module', 'CREDITCALENDAR_STATUS'),
            'allday' => Module::t('module', 'CREDITCALENDAR_ALLDAY'),
            'responsible' => Module::t('module', 'CREDITCALENDAR_RESPONSIBLE'),
            'dateTimeFrom' => 'От: ',
            'dateTimeTo' => 'До: ',
        ];
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
    
}
