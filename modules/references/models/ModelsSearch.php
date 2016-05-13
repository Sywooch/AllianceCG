<?php

namespace app\modules\references\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\references\models\Models;

/**
 * ModelsSearch represents the model behind the search form about `app\modules\references\models\Models`.
 */
class ModelsSearch extends Models
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'brand_id'], 'integer'],
            [['model_name', 'body_type'], 'safe'],
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
        $query = Models::find();

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
            'brand_id' => $this->brand_id,
        ]);

        $query->andFilterWhere(['like', 'model_name', $this->model_name])
            ->andFilterWhere(['like', 'body_type', $this->body_type]);

        return $dataProvider;
    }
}
