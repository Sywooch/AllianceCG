<?php

namespace app\modules\references\models;

use Yii;
use app\modules\references\Module;
use yii\helpers\Html;
use app\modules\admin\models\User;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
use yii\helpers\Url;

/**
 * This is the model class for table "{{%companies}}".
 *
 * @property integer $id
 * @property string $company_name
 * @property string $company_brand
 * @property string $company_logo
 * @property string $company_description
 */
class Companies extends \yii\db\ActiveRecord
{

    const STATUS_BLOCKED = 1;
    const STATUS_ACTIVE = 0;
    const COMPANY_NOLOGO = '@web/img/logo/company_nologo.png';

    public $brandlogo;
    public $logo;
    public $file;
    public $merge_companies;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%companies}}';
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
            [['company_description'], 'string'],
            [['company_name'], 'required'],
            [['company_name', 'company_brand'], 'string', 'max' => 255],
            [['company_description'], 'string'],
            ['author', 'default', 'value' => Yii::$app->user->getId()],
            [['brandlogo'], 'file'],
            // [['brandlogo'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg', 'maxFiles' => 1],
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
            'company_name' => Module::t('module', 'COMPANY_NAME'),
            'company_brand' => Module::t('module', 'COMPANY_BRAND'),
            'brands' => Module::t('module', 'COMPANY_BRAND'),
            'company_logo' => Module::t('module', 'COMPANY_LOGO'),
            'brandlogo' => Module::t('module', 'COMPANY_LOGO'),
            'company_description' => Module::t('module', 'COMPANY_DESCRIPTION'),
            'userscount' => Module::t('module', 'COUNTUSERS'),   
            'globalSearch' => Module::t('module', 'SEARCH'),   
            'created_at' => Module::t('module', 'CREATED_AT'), 
            'updated_at' => Module::t('module', 'UPDATED_AT'), 
            'author' => Module::t('module', 'AUTHOR'),     
            'authorname' => Module::t('module', 'AUTHOR'),     
            'state' => Module::t('module', 'STATE'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserscount()
    {
        // Customer has_many Order via Order.customer_id -> id
        return $this->hasMany(User::className(), ['company' => 'id'])->count();
    }    

    public function getUser()
    {
        return $this->hasMany(User::className(), ['company' => 'id']);
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
    public function getBrands()
    {
        return $this->hasOne(Brands::className(), ['id' => 'company_brand']);
    }

    public function getParentBrands(){
        $model=$this->brands;
        return $model?$model->brand_logo:'';
    }    

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompanybrandlogo()
    {
        $logo = isset($this->brands->brand_logo) ? $this->brands->brandlogo : false;
        return $logo;
    } 

}
