<?php

namespace app\modules\admin\models;
use app\modules\admin\Module;

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
    public function rules()
    {
        return [
            [['department_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Module::t('module', 'ID'),
            'department_name' => Module::t('module', 'DEPARTMENT'),
            'userscount' => Module::t('module', 'COUNTUSERS'),   
            'globalSearch' => Module::t('module', 'SEARCH'),
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

}
