<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\Userroles;

/**
 * UserrolesSearch represents the model behind the search form about `app\modules\admin\models\Userroles`.
 */
class UserrolesSearch extends Userroles
{
    public $globalSearch;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'created_at', 'updated_at'], 'integer'],
            [['role', 'role_description', 'author'], 'safe'],
            [['globalSearch'], 'safe'],
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
        $query = Userroles::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query
            ->orFilterWhere(['like', 'role', $this->globalSearch])
            ->orFilterWhere(['like', 'role_description', $this->globalSearch]);
            // ->andFilterWhere(['like', 'role', $this->role])
            // ->andFilterWhere(['like', 'role_description', $this->role_description])
            // ->andFilterWhere(['like', 'author', $this->author]);

        return $dataProvider;
    }
}
