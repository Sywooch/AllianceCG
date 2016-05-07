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
            [['globalSearch'], 'safe'],
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
            'id' => Module::t('module', 'ID'),
            'role' => Module::t('module', 'ROLE_NAME'),
            'role_description' => Module::t('module', 'ROLE_DESCRIPTION'),
            'created_at' => Module::t('module', 'Created At'),
            'updated_at' => Module::t('module', 'Updated At'),
            'author' => Module::t('module', 'Author'),
            'globalSearch' => Module::t('module', 'SEARCH'),
        ];
    }
}
