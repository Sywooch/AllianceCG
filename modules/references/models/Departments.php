<?php

namespace app\modules\references\models;
use app\modules\admin\models\User;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

use Yii;

/**
 * This is the model class for table "{{%departments}}".
 *
 * @property integer $id
 * @property string $department_name
 * @property integer $user_id
 *
 * @property User $user
 */
class Departments extends \yii\db\ActiveRecord
{

    const STATUS_BLOCKED = 1;
    const STATUS_ACTIVE = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%departments}}';
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
            [['department_name'], 'string', 'max' => 255],
            [['author'], 'safe'],
            ['author', 'default', 'value' => Yii::$app->user->getId()],
        ];
    }

    public function getStatesName()
    {
        return ArrayHelper::getValue(self::getStatesArray(), $this->state);
    }

    public static function getStatesArray()
    {
        return [
            self::STATUS_ACTIVE => 'Активен',
            self::STATUS_BLOCKED => 'Заблокирован',
        ];
    } 

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'department_name' => Yii::t('app', 'DEPARTMENT'),
            'userscount' => Yii::t('app', 'COUNTUSERS'),   
            'globalSearch' => Yii::t('app', 'SEARCH'),
            'state'=>Yii::t('app', 'STATE'),
            'created_at' => Yii::t('app', 'CREATED_AT'), 
            'updated_at' => Yii::t('app', 'UPDATED_AT'), 
            'author' => Yii::t('app', 'AUTHOR'),
            'authorname' => Yii::t('app', 'AUTHOR'),     
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserscount()
    {
        // Customer has_many Order via Order.customer_id -> id
        return $this->hasMany(User::className(), ['department' => 'id'])->count();
    }    

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasMany(User::className(), ['department' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthorname()
    {
        return $this->hasOne(User::className(), ['id' => 'author']);
    }  

}
