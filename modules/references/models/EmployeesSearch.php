<?php

namespace app\modules\references\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\references\models\Employees;

/**
 * EmployeesSearch represents the model behind the search form about `app\modules\references\models\Employees`.
 */
class EmployeesSearch extends Employees
{

    public $company;
    public $department;
    public $position;
    public $brand;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'company_id', 'department_id', 'position_id'], 'integer'],
            [['name', 'surname', 'patronimyc', 'photo'], 'safe'],
            [['fullName', 'globalSearch'], 'safe'],
            [['company', 'department', 'position', 'brand', 'authorname'], 'safe'],
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
        $query = Employees::find();
        $query->joinWith(['company', 'department', 'position', 'brand', 'authorname']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes'=>[
                'id',
                'fullName'=>[
                    'asc'=>['name'=>SORT_ASC, 'surname'=>SORT_ASC, 'patronimyc'=>SORT_ASC],
                    'desc'=>['name'=>SORT_DESC, 'surname'=>SORT_DESC, 'patronimyc'=>SORT_DESC],
                    'label'=>'Full Name',
                    'default'=>SORT_ASC
                ],
                'created_at',
                'updated_at',
            ]
        ]);

        $dataProvider->sort->attributes['company'] = [
                'asc' => ['{{%companies}}.company_name' => SORT_ASC],
                'desc' => ['{{%companies}}.company_name' => SORT_DESC],
            ];  

        $dataProvider->sort->attributes['department'] = [
                'asc' => ['{{%departments}}.department_name' => SORT_ASC],
                'desc' => ['{{%departments}}.department_name' => SORT_DESC],
            ]; 

        $dataProvider->sort->attributes['position'] = [
                'asc' => ['{{%positions}}.position' => SORT_ASC],
                'desc' => ['{{%positions}}.position' => SORT_DESC],
            ];  

        $dataProvider->sort->attributes['brand'] = [
                'asc' => ['{{%brands}}.brand' => SORT_ASC],
                'desc' => ['{{%brands}}.brand' => SORT_DESC],
            ];     

        $dataProvider->sort->attributes['authorname'] = [
                'asc' => ['{{%user}}.full_name' => SORT_ASC],
                'desc' => ['{{%user}}.full_name' => SORT_DESC],
            ];    

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'company_id' => $this->company_id,
            'department_id' => $this->department_id,
            'position_id' => $this->position_id,
        ]);

        $query
            // ->andFilterWhere(['like', 'name', $this->name])
            // ->andFilterWhere(['like', 'surname', $this->surname])
            // ->andFilterWhere(['like', 'patronimyc', $this->patronimyc])
            ->orFilterWhere(['like', '{{%employees}}.name', $this->globalSearch])
            ->orFilterWhere(['like', '{{%employees}}.surname', $this->globalSearch])
            ->orFilterWhere(['like', '{{%employees}}.patronimyc', $this->globalSearch])
            ->orFilterWhere(['like', '{{%companies}}.company_name', $this->globalSearch])
            ->orFilterWhere(['like', '{{%departments}}.department_name', $this->globalSearch])
            ->orFilterWhere(['like', '{{%positions}}.position', $this->globalSearch])
            ->orFilterWhere(['like', '{{%brands}}.brand', $this->globalSearch])
            ->orFilterWhere(['like', '{{%user}}.full_name', $this->globalSearch])
            ;

        // $query->andWhere('name LIKE "%' . $this->fullName . '%" ' .
        //     'OR surname LIKE "%' . $this->fullName . '%"' .
        //     'OR patronimyc LIKE "%' . $this->fullName . '%"'
        // );

        return $dataProvider;
    }

}
