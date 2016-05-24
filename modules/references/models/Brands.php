<?php

namespace app\modules\references\models;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
use app\modules\admin\models\User;
use yii\helpers\Url;
use yii\helpers\Html;

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
    // public $brandlogo;

    const STATUS_BLOCKED = 1;
    const STATUS_ACTIVE = 0;

    const LOGO_PATH = 'img/uploads/brandlogo/';
    const NO_LOGO = '@web/img/logo/company_nologo.png';
    
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
            ['state', 'default', 'value' => 0],
            [['brand', 'brand_logo'], 'string', 'max' => 255],
            ['author', 'default', 'value' => Yii::$app->user->getId()],
            [['brand', 'brand_logo', 'description'], 'safe'],
            // [['file'],'file'],
            [['file'], 'file', 'skipOnEmpty' => true, 'extensions' => ['jpg', 'jpeg','png'],'checkExtensionByMimeType'=>false],
            [['authorname', 'file'], 'safe'],
            [['brand'], 'required'],
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
            'brand' => Yii::t('app', 'BRAND'),
            'brand_logo' => Yii::t('app', 'BRAND_LOGO'),
            'file' => Yii::t('app', 'BRAND_LOGO'),
            'description' => Yii::t('app', 'DESCRIPTION'),
            'state' => Yii::t('app', 'STATE'),            
            'globalSearch' => Yii::t('app', 'SEARCH'),
            'created_at' => Yii::t('app', 'CREATED_AT'), 
            'updated_at' => Yii::t('app', 'UPDATED_AT'), 
            'author' => Yii::t('app', 'AUTHOR'),
            'modelscount' => Yii::t('app', 'MODELSCOUNT'),
            'employeescount' => Yii::t('app', 'EMPLOYEESSCOUNT'),
            'companies' => Yii::t('app', 'COMPANIES'),
        ];
    }

    /**
     * Description
     * @return type
     */
    public function getImageUrl()
    {
        $logo = Url::to('@web/' . $this->brand_logo, true);
        $nologo = self::NO_LOGO;
        $image = (isset($this->brand_logo) && !empty($this->brand_logo) && file_exists($this->brand_logo)) ? $logo : $nologo;
        return $image;
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
    public function getModels()
    {
        return $this->hasMany(Models::className(), ['brand_id' => 'id']);
    } 

    public function getModelscount()
    {
        // Customer has_many Order via Order.customer_id -> id
        return $this->hasMany(Models::className(), ['brand_id' => 'id'])->count();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmployees()
    {
        return $this->hasMany(Employees::className(), ['brand_id' => 'id']);
    } 

    public function getEmployeescount()
    {
        // Customer has_many Order via Order.customer_id -> id
        return $this->hasMany(Employees::className(), ['brand_id' => 'id'])->count();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompanies()
    {
        return $this->hasOne(Companies::className(), ['company_brand' => 'id']);
    }

    public function getCompanylink()
    {
        $link = isset($this->companies->company_name) ? Html::a($this->companies->company_name, ['/references/companies/view', 'id' => $this->companies->id]) : false;
        // Html::a($model->companies->company_name, ['/references/companies/view', 'id' => $model->companies->id]),
        return $link;
    }
}
