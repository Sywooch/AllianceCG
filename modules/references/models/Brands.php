<?php

namespace app\modules\references\models;
use app\modules\references\Module;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
use app\modules\admin\models\User;

use Yii;
 
/**
 * This is the model class for table "{{%brands}}".
 *
 * @property integer $id
 * @property string $brand
 * @property integer $state
 */
class Brands extends \yii\db\ActiveRecord
{

    public $file;

    const STATUS_BLOCKED = 1;
    const STATUS_ACTIVE = 0;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%brands}}';
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
            [['state'], 'integer'],
            [['brand', 'brand_logo'], 'string', 'max' => 255],
            ['author', 'default', 'value' => Yii::$app->user->getId()],
            [['brand', 'brand_logo', 'description'], 'safe'],
            [['file'],'file'],
            [['authorname', 'file'], 'safe'],
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
            'id' => Module::t('module', 'ID'),
            'brand' => Module::t('module', 'BRAND'),
            'brand_logo' => Module::t('module', 'BRAND_LOGO'),
            'file' => Module::t('module', 'BRAND_LOGO'),
            'description' => Module::t('module', 'DESCRIPTION'),
            'state' => Module::t('module', 'STATE'),            
            'globalSearch' => Module::t('module', 'SEARCH'),
            'created_at' => Module::t('module', 'CREATED_AT'), 
            'updated_at' => Module::t('module', 'UPDATED_AT'), 
            'author' => Module::t('module', 'AUTHOR'),

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
