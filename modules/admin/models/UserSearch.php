<?php

namespace app\modules\admin\models;
 
use Yii;
use yii\base\Model;
use yii\data\Sort;
use yii\data\ActiveDataProvider;

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
    public $patronymic;
    public $email;
    public $status;
    public $date_from;
    public $date_to;
    public $photo;
    public $file;

    public function rules()
    {
        return [
            // [['id', 'created_at', 'updated_at', 'status'], 'integer'],
            // [['username', 'auth_key', 'email_confirm_token', 'password_hash', 'password_reset_token', 'email'], 'safe'],
            [['id', 'status'], 'integer'],
            [['username', 'email', 'name', 'surname', 'patronymic', 'fullname', 'email', 'photo', 'position'], 'safe'],
            [['date_from', 'date_to'], 'date', 'format' => 'php:Y-m-d'],
            [['fullname'], 'safe'],
            ['photo', 'safe'],
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
        $query = User::find();

        $sort = new Sort([
            'attributes' => [
                'id',
                'created_at',
                'username',
                'position',
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
                    // 'label' => 'Name',
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

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            $query->where('0=1');
            return $dataProvider;
        }
        
        $query
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'position', $this->position])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['>=', 'created_at', $this->date_from ? strtotime($this->date_from . ' 00:00:00') : null])
            ->andFilterWhere(['<=', 'created_at', $this->date_to ? strtotime($this->date_to . ' 23:59:59') : null])
            ->andWhere('surname LIKE "%' . $this->fullname . '%" ' . 'OR name LIKE "%' . $this->fullname . '%" ' . 'OR patronymic LIKE "%' . $this->fullname . '%" '
            );
 

        // $query->andFilterWhere([
        //     'id' => $this->id,
        //     'created_at' => $this->created_at,
        //     'updated_at' => $this->updated_at,
        //     'status' => $this->status,
        // ]);

        // $query->andFilterWhere(['like', 'username', $this->username])
        //     ->andFilterWhere(['like', 'auth_key', $this->auth_key])
        //     ->andFilterWhere(['like', 'email_confirm_token', $this->email_confirm_token])
        //     ->andFilterWhere(['like', 'password_hash', $this->password_hash])
        //     ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
        //     ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }

}
