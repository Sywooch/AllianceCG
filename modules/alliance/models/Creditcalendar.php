<?php

namespace app\modules\alliance\models;
use app\modules\alliance\Module;
use yii\behaviors\TimestampBehavior;
use rmrevin\yii\fontawesome\FA;
use yii\helpers\ArrayHelper;
use yii\db\Expression;
use app\modules\alliance\models\CreditcalendarComments;
use app\modules\alliance\models\CreditcalendarResponsibles;
use app\modules\admin\models\User;

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
 * @property integer $type
 * @property integer $is_repeat
 * @property string $author
 * @property string $allday
 * @property integer $created_at
 * @property integer $status    
 * @property integer $responsible
 */
class Creditcalendar extends \yii\db\ActiveRecord
{
    public $comment_author;
    public $comment_text;    
    
    const IS_TASK_CALENDAR = 0;
    const IS_TASK_TASK = 1;
    
    const STATUS_ATWORK = 0;
    const STATUS_CLARIFY = 1;
    const STATUS_FINISHED = 2;
    
    const SCENARIO_EVENT = 'createEvent';
    const SCENARIO_TASK = 'createTask';
    const SCENARIO_COMMENT = 'comment';
    
    const DAY_MON = 1;
    const DAY_TUE = 2;
    const DAY_WED = 3;
    const DAY_THU = 4;
    const DAY_FRI = 5;
    const DAY_SAT = 6;
    const DAY_SUN = 7;
    
    public $dateTimeFrom;
    public $dateTimeTo;
    public $responsible;
    public $dateTimeRange;
    
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%calendar}}';
    }    

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreditcalendarcomments()
    {
        return $this->hasMany(CreditcalendarComments::className(), ['calendar_id' => 'id']);
    }
    
    public function getCreditcalendarresponsibles()
    {
        return $this->hasMany(CreditcalendarResponsibles::className(), ['calendar_id' => 'id']);
    }
    
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'author']);
    }

    public function getDisplayUser()
    {
        $displayUser = isset($this->user->full_name) ? $this->user->full_name : FA::icon('remove');
        return $displayUser;
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
    
    public function getStatuses()
    {
        return ArrayHelper::getValue(self::getStatusesArray(), $this->status);
    }

   public function getWeekDays()
   {
       return ArrayHelper::getValue(self::getWeekdaysArray(), $this->week);
   }
    
   public function getWeekdaysArray()
   {
       return[
           self::DAY_MON => 'Пн',
           self::DAY_TUE => 'Вт',
           self::DAY_WED => 'Ср',
           self::DAY_THU => 'Чт',
           self::DAY_FRI => 'Пт',
           self::DAY_SAT => 'Сб',
           self::DAY_SUN => 'Вс',
       ];
   }
    
    public function getResponsibleList()
    {        
        $respquery = CreditcalendarResponsibles::find()
            ->where(['calendar_id' => $this->id])
            ->all();
        foreach ($respquery as $responsible){
            $resps[] = $responsible->responsible_id;
        }
        if(!empty($resps)){
            
            $users = User::find()
                ->where(['IN', 'id', $resps])
                ->all();
            return $users;            
        }
    }
    
    public function getResponsibleemails()
    {
        if($this->getResponsibleList())
        {
            $rsp = $this->getResponsibleList();
            foreach ($rsp as $emails) {
                $mail[] = $emails->email;
            }            
            // $mail = implode(', ', $mail);
            return $mail;
        }
    }
    
    public function getResponsibles()
    {
        if($this->getResponsibleList())
        {
            $rsp = $this->getResponsibleList();                    
            foreach ($rsp as $user) {
                   echo '<span class="label label-success">' . $user->full_name . '</span> ';
                }
        }       
        
    }
    
//    public function getTaskresponsible()
//    {
//        $resp = !empty($this->responsible) ? ' => ' . $this->responsible : '';
//        return $resp;
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
        return ArrayHelper::getValue(self::getTasksArray(), $this->type);
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
        $isTaskIcon = ($this->type == 0) ? FA::icon('calendar') : FA::icon('tasks');
        return $isTaskIcon;
    }
    
    public function getDateTimeFrom()
    {
        $dtfrom = '';
        if(!empty($this->date_from) && $this->date_from !== '0000-00-00') {
            $dt_from = $this->date_from . ' ' . $this->time_from;
            $dtfrom = Yii::$app->formatter->asDateTime($dt_from, 'php:H:i d/m/Y');
        }
        elseif(isset($this->allday) && $this->allday == 1) {
            $dt_from = $this->time_from;
            $dtfrom = Yii::$app->formatter->asTime($dt_from, 'php:H:i'). ' ' . Module::t('module', 'ALLDAYEVENT');
        }
        return $dtfrom;
    }
    
    public function getDateTimeTo()
    {
        $dtto = '';
        if(!empty($this->date_from) && $this->date_from !== '0000-00-00') {
            $dt_to = $this->date_from . ' ' . $this->time_from;
            $dtto = Yii::$app->formatter->asDateTime($dt_to, 'php:H:i d/m/Y');
        }
        elseif(isset($this->allday) && $this->allday == 1) {
            $dt_to = $this->time_from;
            $dtto = Yii::$app->formatter->asTime($dt_to, 'php:H:i'). ' ' . Module::t('module', 'ALLDAYEVENT');
        }
        return $dtto; 
    }
    
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_EVENT] = ['date_from', 'date_to', 'time_from', 'time_to', 'allday', 'author', 'title', 'description', 'location', 'status'];
        $scenarios[self::SCENARIO_TASK] = ['date_from', 'date_to', 'time_from', 'time_to', 'allday', 'author', 'title', 'description', 'location', 'status', 'responsible'];
        $scenarios[self::SCENARIO_COMMENT] = ['date_from', 'date_to', 'time_from', 'time_to', 'allday', 'author', 'title', 'description', 'location', 'status', 'responsible'];
        return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [ 
            ['responsibles', 'safe'],
            [['comment_author', 'comment_text', 'private', 'responsible'], 'safe'],
            // [['comment_text'], 'required', 'on' => self::SCENARIO_COMMENT],
            ['status', 'default', 'value' => self::STATUS_ATWORK],
            ['status', 'in', 'range' => array_keys(self::getStatusesArray())],
            [['date_from', 'time_from', 'date_to', 'time_to', 'dateTimeFrom', 'dateTimeTo', 'allday'], 'safe'],
            [['description'], 'string'],
            ['author', 'default', 'value' => Yii::$app->user->getId()],
            ['type', 'in', 'range' => array_keys(self::getTasksArray()), 'message' => Module::t('module', 'CREDITCALENDAR_LINK_ERROR')],
            [['type'], 'integer'],
            [['title', 'location'], 'string', 'max' => 255],
            // [['date_from', 'date_to', 'time_from', 'time_to', 'title', 'description', 'location', 'status'], 'required', 'on' => self::SCENARIO_EVENT],
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
            'type' => Module::t('module', 'CREDITCALENDAR_IS_TASK'),
            'author' => Module::t('module', 'CREDITCALENDAR_AUTHOR'),
            'created_at' => Module::t('module', 'CREDITCALENDAR_CREATED_AT'),
            'status' => Module::t('module', 'CREDITCALENDAR_STATUS'),
            'allday' => Module::t('module', 'CREDITCALENDAR_ALLDAY'),
            'responsible' => Module::t('module', 'CREDITCALENDAR_RESPONSIBLE'),
            'dateTimeFrom' => 'От: ',
            'dateTimeTo' => 'До: ',
            'private' => Module::t('module', 'CREDITCALENDAR_ISCHIEFTASK'),
            'comment_text' => Module::t('module', 'CREDITCALENDAR_COMMENT'),
            'creditcalendarcomments.comment_text' => Module::t('module', 'CREDITCALENDAR_COMMENTS'),
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





//    public function afterSave($insert, $changedAttributes)
//     {
//         parent::afterSave($insert, $changedAttributes);
////         if ($this->isNewRecord) {
//            $creditcalendarResponsibles = new CreditcalendarResponsibles();
//            foreach ($this->responsible as $responsibles) {
//                $creditcalendarResponsibles->creditcalendar_id = $this->id;
//                $creditcalendarResponsibles->responsible = $responsibles;
//            }
//            $creditcalendarResponsibles->save();
////         }
//     }            
}
