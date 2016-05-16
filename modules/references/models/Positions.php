<?php

namespace app\modules\references\models;

use Yii;
use app\modules\references\Module;
use app\modules\admin\models\User;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%positions}}".
 *
 * @property integer $id
 * @property string $position
 * @property string $description
 */
class Positions extends \yii\db\ActiveRecord
{

    const STATUS_BLOCKED = 1;
    const STATUS_ACTIVE = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%positions}}';
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
            [['position'], 'required'],
            [['description'], 'string'],
            [['position'], 'string', 'max' => 255],
            [['position', 'userscount', 'author'], 'safe'], 
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
     * @return \yii\db\ActiveQuery
     */
    public function getUserscount()
    {
        // Customer has_many Order via Order.customer_id -> id
        return $this->hasMany(User::className(), ['position' => 'id'])->count();
    }    

    public function getUser()
    {
        return $this->hasMany(User::className(), ['position' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthorname()
    {
        return $this->hasOne(User::className(), ['id' => 'author']);
    }  

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Module::t('module', 'ID'),
            'position' => Module::t('module', 'REFERENCES_POSITION'),
            'description' => Module::t('module', 'REFERENCES_DESCRIPTION'), 
            'userscount' => Module::t('module', 'COUNTUSERS'),  
            'state'=>Module::t('module', 'STATE'),
            'created_at' => Module::t('module', 'CREATED_AT'), 
            'updated_at' => Module::t('module', 'UPDATED_AT'), 
            'author' => Module::t('module', 'AUTHOR'),
            'authorname' => Module::t('module', 'AUTHOR'),         
        ];
    }
}
