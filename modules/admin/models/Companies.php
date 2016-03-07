<?php

namespace app\modules\admin\models;

use Yii;
use app\modules\admin\Module;

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
    public $file;

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
            'company_description' => Module::t('module', 'ADMIN_COMPANY_DESCRIPTION'),
        ];
    }
}
