<?php

namespace app\modules\user\models\form;
 
use app\modules\user\models\User;
use yii\base\Model;
use yii\db\ActiveQuery;
use Yii;
 
class ProfileUpdateForm extends Model
{
    public $email;
    public $surname;
    public $name;
    public $patronymic;
    public $allname;
 
    /**
     * @var User
     */
    private $_user;
 
    public function __construct(User $user, $config = [])
    {
        $this->_user = $user;
        parent::__construct($config);
    }
 
    public function init()
    {
        $this->email = $this->_user->email;
        $this->name = $this->_user->name;
        $this->surname = $this->_user->surname;
        $this->patronymic = $this->_user->patronymic;
        $this->allname = $this->_user->allname;
        parent::init();
    }
 
    public function rules()
    {
        return [
            ['email', 'required'],
            ['email', 'email'],
            [
                'email',
                'unique',
                'targetClass' => User::className(),
                'message' => Yii::t('app', 'ERROR_EMAIL_EXISTS'),
                'filter' => function (ActiveQuery $query) {
                        $query->andWhere(['<>', 'id', $this->_user->id]);
                    },
            ],
            ['email', 'string', 'max' => 255],
        ];
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
    
    public function attributeLabels()
    {
        return [
            'email' => Yii::t('app', 'USER_EMAIL'),
            'surname' => Yii::t('app', 'USER_SURNAME'),
            'name' => Yii::t('app', 'USER_NAME'),
            'patronymic' => Yii::t('app', 'USER_PATRONYMIC'),
        ];
    }       
 
    public function update()
    {
        if ($this->validate()) {
            $user = $this->_user;
            $user->name = $this->name;
            $user->surname = $this->surname;
            $user->patronymic = $this->patronymic;
            $user->email = $this->email;
            $user->allname = $this->allname;
            return $user->save();
        } else {
            return false;
        }
    }
}