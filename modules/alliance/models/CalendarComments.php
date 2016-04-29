<?php

namespace app\modules\alliance\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use app\modules\admin\models\User;
use app\modules\alliance\Module;

/**
 * This is the model class for table "{{%calendar_comments}}".
 *
 * @property integer $id
 * @property integer $calendar_id
 * @property integer $user_id
 * @property string $comment_text
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Calendar $calendar
 * @property User $user
 */
class CalendarComments extends \yii\db\ActiveRecord
{

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
    public static function tableName()
    {
        return '{{%calendar_comments}}';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthorname()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['comment_text'], 'required'],
            [['calendar_id', 'user_id', 'created_at', 'updated_at'], 'integer'],
            [['comment_text'], 'string'],
//            [['calendar_id'], 'exist', 'skipOnError' => true, 'targetClass' => Calendar::className(), 'targetAttribute' => ['calendar_id' => 'id']],
//            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Module::t('module', 'ID'),
            'calendar_id' => Module::t('module', 'Calendar ID'),
            'user_id' => Module::t('module', 'CREDITCALENDAR_AUTHOR'),
            'comment_text' => Module::t('module', 'COMMENT'),
            'created_at' => Module::t('module', 'CREATED_AT'),
            'updated_at' => Module::t('module', 'UPDATED_AT'),
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
