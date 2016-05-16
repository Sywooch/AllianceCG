<?php

namespace app\modules\references\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\references\models\Departments;

/**
 * DepartmentsSearch represents the model behind the search form about `app\modules\references\models\Departments`.
 */
class DepartmentsSearch extends Departments
{

    public $globalSearch;
    public $authorname;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['department_name', 'globalSearch', 'authorname'], 'safe'],
            [['department_name'], 'required'],
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
        $query = Departments::find();
        $query -> joinWith(['user']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

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
        // $query->andFilterWhere([
        //     'id' => $this->id,
        // ]);

        // $query->andFilterWhere(['like', 'department_name', $this->department_name]);

        $query->orFilterWhere(['like', 'department_name', $this->globalSearch]);

        return $dataProvider;
    }
}
