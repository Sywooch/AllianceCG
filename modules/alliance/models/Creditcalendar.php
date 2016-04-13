<?php

namespace app\modules\alliance\models;
use app\modules\alliance\Module;
use yii\behaviors\TimestampBehavior;

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
 * @property integer $created_at
 */
class Creditcalendar extends \yii\db\ActiveRecord
{
    
    public $dateTimeFrom;
    public $dateTimeTo;
    
    
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
        return [
            TimestampBehavior::className(),
        ];
    }
    
    public function getDateTimeFrom()
    {
        return $this->date_from . ' ' . $this->time_from;
    }
    
    public function getDateTimeTo()
    {
        return $this->date_to . ' ' . $this->time_to;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [            
//            ['status', 'default', 'value' => self::STATUS_ACTIVE], Yii::$app->user->identity->userfullname
            [['date_from', 'time_from', 'date_to', 'time_to', 'dateTimeFrom', 'dateTimeTo'], 'safe'],
            [['description'], 'string'],
            ['author', 'default', 'value' => Yii::$app->user->identity->userfullname],
            [['is_task', 'is_repeat', 'created_at'], 'integer'],
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
            'dateTimeFrom' => 'От: ',
            'dateTimeTo' => 'До: ',
        ];
    }
}
