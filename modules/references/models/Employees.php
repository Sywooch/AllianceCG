<?php

namespace app\modules\references\models;
use app\modules\admin\models\Companies;
use app\modules\references\models\Positions;
use app\modules\admin\models\Departments;
use app\modules\references\models\Brands;
use app\modules\admin\models\User;
use app\modules\references\Module;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
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
            [['company_id', 'department_id', 'position_id', 'brand_id'], 'required'],
            [['company_id', 'department_id', 'position_id', 'brand_id'], 'integer'],
            [['name', 'surname', 'patronimyc', 'photo'], 'string', 'max' => 255],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Companies::className(), 'targetAttribute' => ['company_id' => 'id']],
            [['brand_id'], 'exist', 'skipOnError' => true, 'targetClass' => Brands::className(), 'targetAttribute' => ['brand_id' => 'id']],
            [['department_id'], 'exist', 'skipOnError' => true, 'targetClass' => Departments::className(), 'targetAttribute' => ['department_id' => 'id']],
            [['position_id'], 'exist', 'skipOnError' => true, 'targetClass' => Positions::className(), 'targetAttribute' => ['position_id' => 'id']],
            [['globalSearch'], 'safe'],
            [['name', 'surname', 'patronimyc', 'brand_id'], 'required'],
            [['fullname', 'file'], 'safe'],
            ['author', 'default', 'value' => Yii::$app->user->getId()],
            [['file'], 'file', 'skipOnEmpty' => true, 'extensions' => ['jpg', 'jpeg','png'],'checkExtensionByMimeType'=>false],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Module::t('module', 'ID'),
            'name' => Module::t('module', 'NAME'),
            'surname' => Module::t('module', 'SURNAME'),
            'patronimyc' => Module::t('module', 'PATRONIMYC'),
            'photo' => Module::t('module', 'PHOTO'),
            'file' => Module::t('module', 'PHOTO'),
            'company_id' => Module::t('module', 'COMPANY'),
            'department_id' => Module::t('module', 'DEPARTMENT'),
            'position_id' => Module::t('module', 'POSITION'),
            'globalSearch' => Module::t('module', 'SEARCH'),
            'fullName'=>Module::t('module', 'FULLNAME'),
            'company'=>Module::t('module', 'COMPANY'),
            'department'=>Module::t('module', 'DEPARTMENT'),
            'position'=>Module::t('module', 'POSITION'),
            'brand_id'=>Module::t('module', 'BRAND'),
            'brand'=>Module::t('module', 'BRAND'),
            'state'=>Module::t('module', 'STATE'),
            'created_at' => Module::t('module', 'CREATED_AT'), 
            'updated_at' => Module::t('module', 'UPDATED_AT'), 
            'author' => Module::t('module', 'AUTHOR'),
            'authorname' => Module::t('module', 'AUTHOR'),
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
        $photo = Url::to('@web/' . $this->photo, true);
        $nophoto = self::NO_PHOTO;
        $image = (isset($this->photo) && !empty($this->photo) && file_exists($this->photo)) ? $photo : $nophoto;
        return $image;
    }

    /**
     * Description
     * @return type
     */
    public function getBrandImageUrl()
    {
        $logo = Url::to('@web/' . $this->brand->brand_logo, true);
        $nologo = self::NO_LOGO;
        $image = (isset($this->brand->brand_logo) && !empty($this->brand->brand_logo) && file_exists($this->brand->brand_logo)) ? $logo : $nologo;
        return $image;
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
