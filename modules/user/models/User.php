<?php

namespace app\modules\user\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\web\IdentityInterface;
use app\modules\user\models\query\UserQuery;
use yii\web\UploadedFile;
use app\modules\references\models\Positions;
use app\modules\user\Module;
use app\modules\references\models\Companies;
use app\modules\admin\models\Userroles;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property integer $id
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $username
 * @property string $auth_key
 * @property string $email_confirm_token
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $status
 */
// class User extends \yii\db\ActiveRecord
class User extends ActiveRecord implements IdentityInterface
{

    // const SCENARIO_PROFILE = 'profile';

    public $file;
    public $fullname;
    public $allname;
    public $mcname;
    public $avatar;

    const SCENARIO_PROFILE = 'profile';

    const STATUS_BLOCKED = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_WAIT = 2;
    
    // const ROLE_MANAGER = 'skassistant';
    // const ROLE_CREDITMANAGER = 'creditmanager';
    // const ROLE_CHIEFCREDIT = 'chiefcredit';
    // const ROLE_HEAD = 'head';
    // const ROLE_ADMIN = 'admin';
    // const ROLE_ROOT = 'root';

    // public function scenarios()
    // {
    //     return [
    //         self::SCENARIO_DEFAULT => ['username', 'email', 'status'],
    //         self::SCENARIO_PROFILE => ['email', 'surname', 'name', 'patronymic', 'company', 'department', 'position', 'photo', 'file'],            
    //     ];
    // }    

    public function scenarios()
    {
        return ArrayHelper::merge(parent::scenarios(), [
            self::SCENARIO_PROFILE => ['email'],
        ]);
    }
 
    public function getuserprofiles()
    {
        return $this->hasOne(Userprofile::className(), ['user_id' => 'id']);
    }

    /**
     * @return UserQuery
     */
    public static function find()
    {
        return Yii::createObject(UserQuery::className(), [get_called_class()]);
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

            // Default GII-generated rules
            
            // Require field - Username   
            [['file'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg', 'maxFiles' => 1],
            [['surname', 'name', 'patronymic', 'full_name', 'photo', 'position'], 'string', 'max' => 255],
            
//            [['surname', 'name', 'patronymic','position', 'email', 'role', 'company'], 'required'],
               

            // Simbol match in username-field
            // ['username', 'match', 'pattern' => '#^[\w_-]+$#i'],

            // Username - unique field
            // ['username', 'unique', 'targetClass' => self::className(), 'message' => Yii::t('app', 'ERROR_USERNAME_EXISTS')],

            // Username - type strind, min. symbol - 2, max. symbol - 255
            [['username', 'avatar', 'role', 'company'], 'string', 'min' => 2, 'max' => 255],
 

            // Field validator - Email
            ['email', 'email'],

            // Email - unique field
            ['email', 'unique', 'targetClass' => self::className(), 'message' => Yii::t('app', 'ERROR_EMAIL_EXISTS')],
 
            // Status - field type integer
            [['status', 'department'], 'integer'],

            // Status - default value "Active"
            ['status', 'default', 'value' => self::STATUS_ACTIVE],

            // Status value in function "getStatusesArray"
            ['status', 'in', 'range' => array_keys(self::getStatusesArray())],
            // ['role', 'in', 'range' => array_keys(self::getRolesArray())],
            [['fullname', 'avatar'], 'safe'],
            [['mcname', 'role', 'company', 'department'], 'safe'],

        ];
    }

    /**
     * @inheritdoc
     */
    
    public function attributeLabels()
    {
        return [
            'created_at' => Module::t('module', 'USER_CREATED_AT'),
            'updated_at' => Module::t('module', 'USER_UPDATED_AT'),
            'username' => Module::t('module', 'USER_USERNAME'),
            'email' => Module::t('module', 'USER_EMAIL'),
            'status' => Module::t('module', 'USER_STATUS'),
            'user_id' => Module::t('module', 'User ID'),
            'surname' => Module::t('module', 'USER_SURNAME'),
            'name' => Module::t('module', 'USER_NAME'),
            'patronymic' => Module::t('module', 'USER_PATRONYMIC'),
            'company' => Module::t('module', 'USER_COMPANY'),
            'department' => Module::t('module', 'USER_DEPARTMENT'),
            'position' => Module::t('module', 'USER_POSITION'),
            'fullname' => Module::t('module', 'USER_FULLNAME'),
            'full_name' => Module::t('module', 'USER_FULLNAME'),
            'allname' => Module::t('module', 'USER_FULLNAME'),
            'photo' => Module::t('module', 'USER_PHOTO'),
            'file' => Module::t('module', 'USER_PHOTO'),
            'company' => Module::t('module', 'USER_COMPANY'),
            'role' => Module::t('module', 'USER_ROLE'),
            'companies' => Module::t('module', 'USER_COMPANY'),
            'positions' => Module::t('module', 'USER_POSITION'),
            'departments' => Module::t('module', 'DEPARTMENT'),
        ];
    }    

    public function getUserfullname()
    {
        $profile = User::find()->where(['id'=>$this->id])->one();
        if ($profile !==null)
            return $profile->full_name;
        return false;
    }
    
    public function getUsercompany()
    {
        $profile = User::find()->where(['id'=>$this->id])->one();
        if ($profile !==null)
            return $profile->company;
        return false;
    }    
    
    public function getStatusName()
    {
        return ArrayHelper::getValue(self::getStatusesArray(), $this->status);
    }

    // public function getRolesName()
    // {
    //     return ArrayHelper::getValue(self::getRolesArray(), $this->role);
    // }

    public function getRoleName()
    {
        $roles = Yii::$app->authManager->getRolesByUser($this->id);
        if (!$roles) {
            return null;
        }

        reset($roles);
        /* @var $role \yii\rbac\Role */
        $role = current($roles);

        return $role->description;
    }    

    public function getFullName()
    {
        $first_name = mb_substr($this->name,0,1, 'UTF-8');
        $last_name = mb_substr($this->name,1);
        $first_name = mb_strtoupper($first_name, 'UTF-8');
        $last_name = mb_strtolower($last_name, 'UTF-8');
        $this->name = $first_name.$last_name;

        $this->fullname=$this->surname . ' ' . mb_strtoupper(mb_substr($this->name,0,1, 'UTF-8'), 'UTF-8') . '.' . mb_strtoupper(mb_substr($this->patronymic,0,1, 'UTF-8'), 'UTF-8') . '.';
        return $this->fullname;
    }
    
    public function getImageurl()
    {
        // return \Yii::$app->homeUrl.$this->photo;
        
        return !empty($this->photo) ? \Yii::$app->homeUrl.$this->photo : \Yii::$app->homeUrl.'img/logo/avatar.jpeg';
    }   
    
    public function getPositionByPk()
    {
        $userposition = Positions::find()
            ->where(['id' => $this->position])
            ->one();
        return $userposition->position;        
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserroles()
    {
        return $this->hasOne(Userroles::className(), ['role' => 'role']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPositions()
    {
        return $this->hasOne(Positions::className(), ['id' => 'position']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompanies()
    {
        return $this->hasOne(Companies::className(), ['id' => 'company']);
    }

    public function getAllName()
    {
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

        $first_patronymic = mb_substr($this->patronymic,0,1, 'UTF-8');
        $last_patronymic = mb_substr($this->patronymic,1);
        $first_patronymic = mb_strtoupper($first_patronymic, 'UTF-8');
        $last_patronymic = mb_strtolower($last_patronymic, 'UTF-8');
        $this->patronymic = $first_patronymic.$last_patronymic;

        $this->allname=$this->surname . ' ' . $this->name . ' ' . $this->patronymic;
        return $this->allname;
    }    
 
    public static function getStatusesArray()
    {
        return [
            self::STATUS_ACTIVE => 'Активен',
            self::STATUS_BLOCKED => 'Заблокирован',
            self::STATUS_WAIT => 'Ожидает подтверждения',
        ];
    }

    // public static function getRolesArray()
    // {
    //     return [
    //         self::ROLE_MANAGER => 'Менеджер',
    //         self::ROLE_HEAD => 'Руководитель',
    //         self::ROLE_ADMIN => 'Администратор',
    //         self::ROLE_ROOT => 'Суперпользователь',
    //         self::ROLE_CHIEFCREDIT => 'Руководитель ОКиС',
    //         self::ROLE_CREDITMANAGER => 'Кредитный специалист',
    //     ];
    // }    

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }


    /**
    * @inheritdoc
    */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }
 
    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('findIdentityByAccessToken is not implemented.');
    }
 
    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }
 
    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }
 
    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }        

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email]);
    }    
 
    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }    

   /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }
 
    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }
 
    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert) {
                $this->generateAuthKey();
            }
            return true;
        }
        return false;
    } 
    
    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token, $timeout)
    {
        if (!static::isPasswordResetTokenValid($token, $timeout)) {
            return null;
        }
        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }
 
    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    // public static function isPasswordResetTokenValid($token)
    // {
    //     if (empty($token)) {
    //         return false;
    //     }
    //     $expire = Yii::$app->params['user.passwordResetTokenExpire'];
    //     $parts = explode('_', $token);
    //     $timestamp = (int) end($parts);
    //     return $timestamp + $expire >= time();
    // }
    public static function isPasswordResetTokenValid($token, $timeout)
    {
        if (empty($token)) {
            return false;
        }
        // $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        return $timestamp + $timeout >= time();
    }
 
    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }
 
    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }      

   /**
     * @param string $email_confirm_token
     * @return static|null
     */
    public static function findByEmailConfirmToken($email_confirm_token)
    {
        return static::findOne(['email_confirm_token' => $email_confirm_token, 'status' => self::STATUS_WAIT]);
    }
 
    /**
     * Generates email confirmation token
     */
    public function generateEmailConfirmToken()
    {
        $this->email_confirm_token = Yii::$app->security->generateRandomString();
    }
 
    /**
     * Removes email confirmation token
     */
    public function removeEmailConfirmToken()
    {
        $this->email_confirm_token = null;
    }     

}
