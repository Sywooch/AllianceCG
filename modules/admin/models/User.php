<?php 

namespace app\modules\admin\models;
 
use yii\helpers\ArrayHelper;
// use app\modules\user\Module;
use app\modules\admin\Module;
use Yii;
 
class User extends \app\modules\user\models\User
{
    const SCENARIO_ADMIN_CREATE = 'adminCreate';
    const SCENARIO_ADMIN_UPDATE = 'adminUpdate';
    const ROLE_USER = 'authGuest';
 
    public $newPassword;
    public $newPasswordRepeat;
    public $fullname;
    public $file;
 
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['newPassword', 'newPasswordRepeat', 'role'], 'required', 'on' => self::SCENARIO_ADMIN_CREATE],
            ['newPassword', 'string', 'min' => 6],
            ['newPasswordRepeat', 'compare', 'compareAttribute' => 'newPassword'],
            [['fullName', 'photo', 'file', 'role', 'company'], 'safe'],
            [['file'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg', 'maxFiles' => 1],
        ]);
    }
 
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_ADMIN_CREATE] = ['surname', 'name', 'photo', 'role', 'patronymic', 'email', 'position', 'company', 'status', 'newPassword', 'newPasswordRepeat'];
        $scenarios[self::SCENARIO_ADMIN_UPDATE] = ['surname', 'name', 'photo', 'role', 'patronymic', 'email', 'position', 'company', 'status', 'newPassword', 'newPasswordRepeat'];
        return $scenarios;
    }
 
    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'newPassword' => Module::t('module', 'ADMIN_USER_NEW_PASSWORD'),
            'newPasswordRepeat' => Module::t('module', 'ADMIN_USER_REPEAT_PASSWORD'),
            'role' => Module::t('module', 'ADMIN_USERS_ROLE'),
            'userroles' => Module::t('module', 'ADMIN_USERS_ROLE'),
        ]);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if (!empty($this->newPassword)) {
                $this->setPassword($this->newPassword);

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
                $this->username=$this->surname.mb_substr($this->name,0,1,'UTF-8').mb_substr($this->patronymic,0,1,'UTF-8');
                $this->full_name = $this->name . ' ' . $this->surname;
            }
            else {
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
                $this->username=$this->surname.mb_substr($this->name,0,1,'UTF-8').mb_substr($this->patronymic,0,1,'UTF-8');
                $this->full_name = $this->name . ' ' . $this->surname;
            }
            return true;
        }
        return false;
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
    
    public function afterSave($insert, $changedAttributes)
     {
         parent::afterSave($insert, $changedAttributes);
         // установка роли пользователя
         $auth = Yii::$app->authManager;
         $name = $this->role ? $this->role : 'authGuest';
         $role = $auth->getRole($name);
         if (!$insert) {
             $auth->revokeAll($this->id);
         }
         $auth->assign($role, $this->id);
     }    
    
}