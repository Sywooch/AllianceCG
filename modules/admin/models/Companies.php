<?php

namespace app\modules\admin\models;

use Yii;
use app\modules\admin\Module;
use yii\helpers\Html;

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
    public function rules()
    {
        return [
            [['company_description'], 'string'],
            [['company_name', 'company_brand'], 'required'],
            [['company_name', 'company_brand', 'company_logo'], 'string', 'max' => 255],
            [['company_description'], 'string'],
            [['brandlogo'], 'safe'],
            [['brandlogo'], 'file'],
            // [['brandlogo'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg', 'maxFiles' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Module::t('module', 'ID'),
            'company_name' => Module::t('module', 'ADMIN_COMPANY_NAME'),
            'company_brand' => Module::t('module', 'ADMIN_COMPANY_BRAND'),
            'company_logo' => Module::t('module', 'ADMIN_COMPANY_LOGO'),
            'brandlogo' => Module::t('module', 'ADMIN_COMPANY_LOGO'),
            'company_description' => Module::t('module', 'ADMIN_COMPANY_DESCRIPTION'),
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
        return $this->hasMany(User::className(), ['company' => 'id'])->count();
    }    

    public function getUser()
    {
        return $this->hasMany(User::className(), ['company' => 'id']);
    }

    public function getLogoName()
    {
        $company_title = !empty($this->company_logo) ? Html::img('/' . $this->company_logo,['height' => '50']) . ' ' . $this->company_name : $this->company_name;
        return $company_title;
    }

    public function getSingleLogo()
    {
        $nologo = 'img/logo/company_nologo.png';
        $logo = !empty($this->company_logo) ? '/' . $this->company_logo : '/' . $nologo;
        return $logo;
    }    
}
