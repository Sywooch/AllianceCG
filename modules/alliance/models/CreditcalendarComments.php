<?php

namespace app\modules\alliance\models;
use app\modules\alliance\models\Creditcalendar;
use yii\behaviors\TimestampBehavior;
use app\modules\admin\models\User;
use rmrevin\yii\fontawesome\FA;

use Yii;

/**
 * This is the model class for table "{{%creditcalendar_comments}}".
 *
 * @property integer $id
 * @property integer $creditcalendar_id
 * @property string $comment_author
 * @property string $comment_text
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Creditcalendar $creditcalendar
 */
class CreditcalendarComments extends \yii\db\ActiveRecord
{
    
    public $title;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%creditcalendar_comments}}';
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
//            [['creditcalendar_id', 'comment_author', 'created_at', 'updated_at'], 'required'],
            [['creditcalendar_id', 'created_at', 'updated_at'], 'integer'],
            [['comment_text'], 'string'],
            [['comment_author'], 'integer'],
            [['creditcalendar_id'], 'exist', 'skipOnError' => true, 'targetClass' => Creditcalendar::className(), 'targetAttribute' => ['creditcalendar_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'creditcalendar_id' => Yii::t('app', 'Creditcalendar ID'),
            'comment_author' => Yii::t('app', 'Comment Author'),
            'comment_text' => Yii::t('app', 'Comment Text'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreditcalendar()
    {
        return $this->hasOne(Creditcalendar::className(), ['id' => 'creditcalendar_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'comment_author']);
    }

    public function getDisplayUser()
    {
        $displayUser = isset($this->user->full_name) ? $this->user->full_name : FA::icon('remove');
        return $displayUser;
    }
}
