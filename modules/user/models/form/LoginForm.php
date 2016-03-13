<?php

namespace app\models;
namespace app\modules\user\models\form;

use app\modules\user\models\User;
use Yii;
use yii\base\Model;
use app\modules\user\Module;

/**
 * LoginForm is the model behind the login form.
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword()
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
 
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError('password', Yii::t('app', 'ERROR_WRONG_USERNAME_OR_PASSWORD'));
            } elseif ($user && $user->status == User::STATUS_BLOCKED) {
                $this->addError('username', Yii::t('app', 'ERROR_PROFILE_BLOCKED'));
            } 
            elseif ($user && $user->status == User::STATUS_WAIT) {
                $this->addError('username', Yii::t('app', 'ERROR_PROFILE_NOT_CONFIRMED'));
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            // $this->_user = User::findByUsername($this->username);
            if(strpos($this->username, '@') !== false){
                $this->_user = User::findByEmail($this->username);
            }
            else {
                $this->_user = User::findByUsername($this->username);
            }
        }

        return $this->_user;
    }

    public function attributeLabels()
    {
        return [
            'username' => Module::t('module', 'USER_USERNAME'),
            'password' => Module::t('module', 'USER_PASSWORD'),
            'rememberMe' => Module::t('module', 'USER_REMEMBER_ME'),
        ];
    }
}
