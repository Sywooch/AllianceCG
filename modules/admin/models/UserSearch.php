<?php

namespace app\modules\admin\models;
 
use Yii;
use yii\base\Model;
use yii\data\Sort;
use yii\data\ActiveDataProvider;
use app\modules\admin\Module;

/**
 * UserSearch represents the model behind the search form about `app\modules\user\models\User`.
 */
class UserSearch extends Model
{
    /**
     * @inheritdoc
     */

    public $id;
    public $username;
    public $fullname;
    public $allname;
    public $name;
    public $surname;
    public $position;
    public $company;
    public $patronymic;
    public $email;
    public $status;
    public $date_from;
    public $date_to;
    public $photo;
    public $file;
    public $role;
    public $userroles;
    public $globalSearch;
    public $positions;
    public $companies;
    public $department;
    public $departments;

    public function rules()
    {
        return [
            // [['id', 'status'], 'integer'],
            [['username', 'email', 'name', 'surname', 'patronymic', 'fullname', 'photo', 'position', 'role'], 'safe'],
            [['date_from', 'date_to'], 'date', 'format' => 'php:Y-m-d'],
            [['fullname', 'company', 'userroles', 'globalSearch', 'positions', 'companies', 'department'], 'safe'],
            ['photo', 'safe'],
            ['departments', 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => Yii::t('app', 'USER_CREATED'),
            'updated_at' => Yii::t('app', 'USER_UPDATED'),
            'surname' => Yii::t('app', 'USER_SURNAME'),
            'name' => Yii::t('app', 'USER_NAME'),
            'patronymic' => Yii::t('app', 'USER_PATRONYMIC'),
            'fullname' => Yii::t('app', 'USER_FULLNAME'),
            'shortname' => Yii::t('app', 'USER_SHORTNAME'),
            'position' => Yii::t('app', 'USER_POSITION'),
            'username' => Yii::t('app', 'USER_USERNAME'),
            'email' => Yii::t('app', 'USER_EMAIL'),
            'status' => Yii::t('app', 'USER_STATUS'),
            'userroles' => Yii::t('app', 'ADMIN_USERS_ROLE'),
            'globalSearch' => Yii::t('app', 'SEARCH'),
            'departments' => Yii::t('app', 'DEPARTMENT'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = User::find()->where(['<>','{{%user}}.role', 'root']);        
        $query->joinWith(['userroles', 'positions', 'companies', 'departments']);


        $sort = new Sort([
            'attributes' => [
                'id',
                'full_name',
                'created_at',
                'username',
                'position',
                'company',
                'role',
                'status',
                'fullname' => [
                    'asc' => ['name' => SORT_ASC, 'surname' => SORT_ASC],
                    'desc' => ['name' => SORT_DESC, 'surname' => SORT_DESC],
                    'label' => 'fullname',
                    'default' => SORT_ASC
                ],
                'email' => [
                    'asc' => ['username' => SORT_ASC, 'email' => SORT_ASC],
                    'desc' => ['username' => SORT_DESC, 'email' => SORT_DESC],
                    'default' => SORT_DESC,
                ],
            ],
        ]);   

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => $sort,
            // 'sort' => [
            //     'defaultOrder' => ['id' => SORT_DESC],
            //     // 'attributes' => ['username','email','status'],
            // ]
        ]);   

        $dataProvider->sort->attributes['positions'] = [
            'asc' => ['{{%positions}}.position' => SORT_ASC],
            'desc' => ['{{%positions}}.position' => SORT_DESC],
        ];   

        $dataProvider->sort->attributes['departments'] = [
            'asc' => ['{{%departments}}.department_name' => SORT_ASC],
            'desc' => ['{{%departments}}.department_name' => SORT_DESC],
        ];   
        
        $dataProvider->sort->attributes['companies'] = [
            'asc' => ['{{%companies}}.company_name' => SORT_ASC],
            'desc' => ['{{%companies}}.company_name' => SORT_DESC],
        ];    

        $dataProvider->sort->attributes['userroles'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['{{%userroles}}.role_description' => SORT_ASC],
            'desc' => ['{{%userroles}}.role_description' => SORT_DESC],
        ];        

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            $query->where('0=1');
            return $dataProvider;
        }
        
        $query            
            ->orFilterWhere(['like', 'name', $this->globalSearch])
            // ->orFilterWhere(['like', 'name', $this->globalSearch])
            // ->orFilterWhere(['like', 'surname', $this->globalSearch])
            // ->orFilterWhere(['like', 'patronymic', $this->globalSearch])
            // ->orFilterWhere(['like', '{{%user}}.position', $this->globalSearch])
            // ->orFilterWhere(['like', 'company', $this->globalSearch])
            // ->orFilterWhere(['like', '{{%user}}.role', $this->globalSearch])
            // ->orFilterWhere(['like', 'email', $this->globalSearch])
            // ->orFilterWhere(['like', 'status', $this->globalSearch])
            // ->orFilterWhere(['like', '{{%userroles}}.role_description', $this->userroles])
            ;


            // ->andFilterWhere(['like', 'username', $this->username])
            // ->andFilterWhere(['like', 'position', $this->position])
            // ->andFilterWhere(['like', 'company', $this->company])
            // ->andFilterWhere(['like', 'status', $this->status])
            // ->andFilterWhere(['like', 'role', $this->role])
            // ->andFilterWhere(['like', 'email', $this->email])
            // ->andFilterWhere(['>=', 'created_at', $this->date_from ? strtotime($this->date_from . ' 00:00:00') : null])
            // ->andFilterWhere(['<=', 'created_at', $this->date_to ? strtotime($this->date_to . ' 23:59:59') : null])
            // ->andFilterWhere(['like', '{{%userroles}}.role_description', $this->user_roles])
//            ->andWhere('surname LIKE "%' . $this->fullname . '%" ' . 'OR name LIKE "%' . $this->fullname . '%" ' . 'OR patronymic LIKE "%' . $this->fullname . '%" '
//            )
            // ;

        return $dataProvider;
    }

}
