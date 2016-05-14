<?php

namespace app\modules\references\models;

use Yii;
use app\modules\references\Module;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
use app\modules\admin\models\User;

/**
 * This is the model class for table "{{%bodytypes}}".
 *
 * @property integer $id
 * @property string $body_type
 * @property string $description
 */
class Bodytypes extends \yii\db\ActiveRecord
{


    const STATUS_BLOCKED = 1;
    const STATUS_ACTIVE = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%bodytypes}}';
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
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['body_type'], 'string', 'max' => 255],
            [['body_type'], 'required'],
            ['author', 'default', 'value' => Yii::$app->user->getId()],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Module::t('module', 'ID'),
            'body_type' => Module::t('module', 'BODY_TYPE'),
            'description' => Module::t('module', 'BODY_DESCRIPTION'),
            'state' => Module::t('module', 'STATE'),
            'created_at' => Module::t('module', 'CREATED_AT'),
            'updated_at' => Module::t('module', 'UPDATED_AT'),
            'author' => Module::t('module', 'AUTHOR'),
            'globalSearch' => Module::t('module', 'SEARCH'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthorname()
    {
        return $this->hasOne(User::className(), ['id' => 'author']);
    }   
}
