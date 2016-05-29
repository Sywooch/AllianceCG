<?php

namespace app\modules\references\models;
use app\modules\references\models\Companies;
use app\modules\references\models\Positions;
use app\modules\references\models\Departments;
use app\modules\references\models\Brands;
use app\modules\admin\models\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\behaviors\TimestampBehavior;

use Yii;

/**
 * This is the model class for table "{{%employees}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $surname
 * @property string $patronimyc
 * @property string $photo
 * @property integer $company_id
 * @property integer $department_id
 * @property integer $position_id
 *
 * @property Companies $company
 * @property Departments $department
 * @property Positions $position
 */
class Employees extends \yii\db\ActiveRecord
{

    const STATUS_BLOCKED = 1;
    const STATUS_ACTIVE = 0;
    const SALES_MANAGER = "Менеджер отдела продаж";
    const HEAD_OF_SALES_DEPARTMENT = "Руководитель отдела продаж";
    const MASTER_CONSULTANT = 'Мастер-консультант';
    const LOGO_PATH = 'img/uploads/brandlogo/';
    const NO_LOGO = '@web/img/logo/company_nologo.png';
    const PHOTO_PATH = 'img/uploads/employeesphoto/';
    const NO_PHOTO = '@web/img/logo/avatar.jpeg';

    public $globalSearch;
    public $fullname;
    public $file;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%employees}}';
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
            [['company_id', 'department_id', 'position_id'], 'required'],
            [['company_id', 'department_id', 'position_id', 'brand_id'], 'integer'],
            [['name', 'surname', 'patronimyc', 'photo'], 'string', 'max' => 255],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Companies::className(), 'targetAttribute' => ['company_id' => 'id']],
            [['brand_id'], 'exist', 'skipOnError' => true, 'targetClass' => Brands::className(), 'targetAttribute' => ['brand_id' => 'id']],
            [['department_id'], 'exist', 'skipOnError' => true, 'targetClass' => Departments::className(), 'targetAttribute' => ['department_id' => 'id']],
            [['position_id'], 'exist', 'skipOnError' => true, 'targetClass' => Positions::className(), 'targetAttribute' => ['position_id' => 'id']],
            [['globalSearch'], 'safe'],
            [['name', 'surname', 'patronimyc'], 'required'],
            [['fullname', 'file'], 'safe'],
            ['author', 'default', 'value' => Yii::$app->user->getId()],
            ['brand_id', 'default', 'value' => 0],
            [['file'], 'file', 'skipOnEmpty' => true, 'extensions' => ['jpg', 'jpeg','png'],'checkExtensionByMimeType'=>false],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'NAME'),
            'surname' => Yii::t('app', 'SURNAME'),
            'patronimyc' => Yii::t('app', 'PATRONIMYC'),
            'photo' => Yii::t('app', 'PHOTO'),
            'file' => Yii::t('app', 'PHOTO'),
            'company_id' => Yii::t('app', 'COMPANY'),
            'companies' => Yii::t('app', 'COMPANY'),
            'department_id' => Yii::t('app', 'DEPARTMENT'),
            'position_id' => Yii::t('app', 'POSITION'),
            'globalSearch' => Yii::t('app', 'SEARCH'),
            'fullName'=>Yii::t('app', 'FULLNAME'),
            'company'=>Yii::t('app', 'COMPANY'),
            'department'=>Yii::t('app', 'DEPARTMENT'),
            'position'=>Yii::t('app', 'POSITION'),
            'brand_id'=>Yii::t('app', 'BRAND'),
            'brand'=>Yii::t('app', 'BRAND'),
            'state'=>Yii::t('app', 'STATE'),
            'created_at' => Yii::t('app', 'CREATED_AT'), 
            'updated_at' => Yii::t('app', 'UPDATED_AT'), 
            'author' => Yii::t('app', 'AUTHOR'),
            'authorname' => Yii::t('app', 'AUTHOR'),
            'brandlogo' => Yii::t('app', 'BRAND_LOGO'),
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
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Companies::className(), ['id' => 'company_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment()
    {
        return $this->hasOne(Departments::className(), ['id' => 'department_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosition()
    {
        return $this->hasOne(Positions::className(), ['id' => 'position_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBrand()
    {
        return $this->hasOne(Brands::className(), ['id' => 'brand_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthorname()
    {
        return $this->hasOne(User::className(), ['id' => 'author']);
    }  

    /**
     * Description
     * @return type
     */
    public function getImageUrl()
    {
        $photo = ($this->brand_id > 0) ? Url::to('@web/' . $this->photo, true) : false;
        $nophoto = self::NO_PHOTO;
        $image = ($this->brand_id > 0 && isset($this->photo) && !empty($this->photo) && file_exists($this->photo)) ? $photo : $nophoto;
        return $image;
    }

    /**
     * Description
     * @return type
     */
    public function getBrandImageUrl()
    {
        $logo = ($this->brand_id > 0) ? Url::to('@web/' . $this->brand->brand_logo, true) : false;
        $nologo = self::NO_LOGO;
        $image = ($this->brand_id > 0 && isset($this->brand->brand_logo) && !empty($this->brand->brand_logo) && file_exists($this->brand->brand_logo)) ? $logo : $nologo;
        return $image;
    }

    public function getBrandlink()
    {
        $link = isset($this->brand->brand) ? Html::a($this->brand->brand, ['/references/brands/view', 'id' => $this->brand->id]) : false;
        return $link;
    }

    public function getCompanylink()
    {
        $link = isset($this->company->company_name) ? Html::a($this->company->company_name, ['/references/companies/view', 'id' => $this->company->id]) : false;
        return $link;
    }

    public function getDepartmentlink()
    {
        $link = isset($this->department->department_name) ? Html::a($this->department->department_name, ['/references/departments/view', 'id' => $this->department->id]) : false;
        return $link;
    }

    public function getPositionlink()
    {
        $link = isset($this->position->position) ? Html::a($this->position->position, ['/references/positions/view', 'id' => $this->position->id]) : false;
        return $link;
    }

    public function getFullName() {

        $first_name = mb_substr($this->name,0,1, 'UTF-8');
        $last_name = mb_substr($this->name,1);
        $first_name = mb_strtoupper($first_name, 'UTF-8');
        $last_name = mb_strtolower($last_name, 'UTF-8');
        $this->name = $first_name.$last_name;

        $first_surname = mb_substr($this->surname,0,1, 'UTF-8');
        $last_surname = mb_substr($this->surname,1);
        $first_surname = mb_strtoupper($first_surname, 'UTF-8');
        $last_surname = mb_strtolower($last_surname, 'UTF-8');
        $this->surname = $first_surname.$last_surname;

        $first_patronymic = mb_substr($this->patronimyc,0,1, 'UTF-8');
        $last_patronymic = mb_substr($this->patronimyc,1);
        $first_patronymic = mb_strtoupper($first_patronymic, 'UTF-8');
        $last_patronymic = mb_strtolower($last_patronymic, 'UTF-8');
        $this->patronimyc = $first_patronymic.$last_patronymic;

        return $this->name . ' ' . $this->patronimyc . ' ' . $this->surname;
    } 


}
