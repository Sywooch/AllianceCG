<?php

namespace app\modules\admin\models;
use yii\behaviors\TimestampBehavior;

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
            [['role'], 'required'],
            [['role_description'], 'string'],
            [['created_at', 'updated_at'], 'integer'],
            [['role', 'author'], 'string', 'max' => 255],
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
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'role' => Yii::t('app', 'Role'),
            'role_description' => Yii::t('app', 'Role Description'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'author' => Yii::t('app', 'Author'),
        ];
    }
}
