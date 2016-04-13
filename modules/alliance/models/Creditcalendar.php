<?php

namespace app\modules\alliance\models;

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
    public function rules()
    {
        return [
            [['date_from', 'time_from', 'date_to', 'time_to'], 'safe'],
            [['description'], 'string'],
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
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'date_from' => Yii::t('app', 'Date From'),
            'time_from' => Yii::t('app', 'Time From'),
            'date_to' => Yii::t('app', 'Date To'),
            'time_to' => Yii::t('app', 'Time To'),
            'description' => Yii::t('app', 'Description'),
            'location' => Yii::t('app', 'Location'),
            'is_task' => Yii::t('app', 'Is Task'),
            'is_repeat' => Yii::t('app', 'Is Repeat'),
            'author' => Yii::t('app', 'Author'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }
}
