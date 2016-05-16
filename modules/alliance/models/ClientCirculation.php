<?php

namespace app\modules\alliance\models;

use Yii;
use app\modules\admin\models\User;
use yii\behaviors\TimestampBehavior;
use app\modules\alliance\Module;
use yii\helpers\ArrayHelper;
use app\modules\references\models\Regions;

/**
 * This is the model class for table "{{%client_circulation}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property string $region
 * @property integer $state
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $author
 * @property integer $region_id
 */
class ClientCirculation extends \yii\db\ActiveRecord
{

    public $globalSearch;

    const STATUS_BLOCKED = 1;
    const STATUS_ACTIVE = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%client_circulation}}';
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
            [['state', 'created_at', 'updated_at', 'region_id'], 'integer'],
            [['name', 'email', 'author'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 16],
            [['globalSearch'], 'safe'],
            ['author', 'default', 'value' => Yii::$app->user->getId()],
            [['name', 'phone', 'email', 'region_id'], 'required'],
            [['phone', 'email'], 'unique'],
            ['email', 'email'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Module::t('module', 'ID'),
            'name' => Module::t('module', 'CLIENTNAME'),
            'phone' => Module::t('module', 'PHONE'),
            'email' => Module::t('module', 'EMAIL'),
            'state' => Module::t('module', 'STATE'),
            'created_at' => Module::t('module', 'CREATED_AT'),
            'updated_at' => Module::t('module', 'UPDATED_AT'),
            'author' => Module::t('module', 'AUTHOR'),
            'region_id' => Module::t('module', 'REGION'),
            'regions' => Module::t('module', 'REGION'),
            'authorname' => Module::t('module', 'AUTHOR'),
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthorname()
    {
        return $this->hasOne(User::className(), ['id' => 'author']);
    }  

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegions()
    {
        return $this->hasOne(Regions::className(), ['id' => 'region_id']);
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
}
