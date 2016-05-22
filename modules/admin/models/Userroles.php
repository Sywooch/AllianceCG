<?php

namespace app\modules\admin\models;
use yii\behaviors\TimestampBehavior;
// use app\modules\admin\Module;

use Yii;

/**
 * This is the model class for table "{{%userroles}}".
 *
 * @property integer $id
 * @property string $role
 * @property string $role_description
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $author
 */
class Userroles extends \yii\db\ActiveRecord
{

    public $globalSearch;
    public $userroles_count;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%userroles}}';
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
            [['role', 'role_description'], 'required'],
            [['role_description'], 'string'],
            [['created_at', 'updated_at'], 'integer'],
            [['role', 'author'], 'string', 'max' => 255],
            [['globalSearch', 'userroles_count'], 'safe'],
            ['author', 'default', 'value' => Yii::$app->user->getId()],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsersbyrole()
    {
        return $this->hasMany(User::className(), ['role' => 'role']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserrolescount()
    {
        // Customer has_many Order via Order.customer_id -> id
        return $this->hasMany(User::className(), ['role' => 'role'])->count();
    }    

    public function getUser()
    {
        return $this->hasMany(User::className(), ['role' => 'role']);
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
            'id' => Yii::t('app', 'ID'),
            'role' => Yii::t('app', 'ROLE_NAME'),
            'role_description' => Yii::t('app', 'ROLE_DESCRIPTION'),
            'created_at' => Yii::t('app', 'CREATED_AT'),
            'updated_at' => Yii::t('app', 'UPDATED_AT'),
            'author' => Yii::t('app', 'AUTHOR'),
            'authorname' => Yii::t('app', 'AUTHOR'),
            'globalSearch' => Yii::t('app', 'SEARCH'),
            'userroles_count' => Yii::t('app', 'USERROLESCOUNT'),
        ];
    }
    
}
