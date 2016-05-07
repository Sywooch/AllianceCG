<?php

namespace app\modules\admin\models;
use yii\behaviors\TimestampBehavior;
use app\modules\admin\Module;

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
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Module::t('module', 'ID'),
            'role' => Module::t('module', 'ROLE_NAME'),
            'role_description' => Module::t('module', 'ROLE_DESCRIPTION'),
            'created_at' => Module::t('module', 'CREATED_AT'),
            'updated_at' => Module::t('module', 'UPDATED_AT'),
            'author' => Module::t('module', 'AUTHOR'),
            'globalSearch' => Module::t('module', 'SEARCH'),
            'userroles_count' => Module::t('module', 'USERROLESCOUNT'),
        ];
    }
}
