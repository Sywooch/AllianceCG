<?php

namespace app\modules\references\models;

use Yii;
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
            'id' => Yii::t('app', 'ID'),
            'company_name' => Yii::t('app', 'COMPANY_NAME'),
            'company_brand' => Yii::t('app', 'COMPANY_BRAND'),
            'brands' => Yii::t('app', 'COMPANY_BRAND'),
            'company_logo' => Yii::t('app', 'COMPANY_LOGO'),
            'brandlogo' => Yii::t('app', 'COMPANY_LOGO'),
            'company_description' => Yii::t('app', 'COMPANY_DESCRIPTION'),
            'userscount' => Yii::t('app', 'COUNTUSERS'),   
            'globalSearch' => Yii::t('app', 'SEARCH'),   
            'created_at' => Yii::t('app', 'CREATED_AT'), 
            'updated_at' => Yii::t('app', 'UPDATED_AT'), 
            'author' => Yii::t('app', 'AUTHOR'),     
            'authorname' => Yii::t('app', 'AUTHOR'),     
            'state' => Yii::t('app', 'STATE'),
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
    public function getEmployees()
    {
        return $this->hasMany(Employees::className(), ['company_id' => 'id']);
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
        $logo = isset($this->brands->brand_logo) ? '/' . $this->brands->brand_logo : false;
        return $logo;
    } 

    public function getBrandlink()
    {
        $link = isset($this->brands->brand) ? Html::a($this->brands->brand, ['/references/brands/view', 'id' => $this->brands->id]) : false;
        // Html::a($model->companies->company_name, ['/references/companies/view', 'id' => $model->companies->id]),
        return $link;
    }

}
