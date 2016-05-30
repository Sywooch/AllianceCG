<?php

namespace app\modules\alliance\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\alliance\models\Clientcirculationcomment;

/**
 * ClientcirculationcommentSearch represents the model behind the search form about `app\modules\alliance\models\Clientcirculationcomment`.
 */
class ClientcirculationcommentSearch extends Clientcirculationcomment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'clientcirculation_id', 'state', 'created_at', 'updated_at'], 'integer'],
            [['contact_type', 'target', 'car_model', 'comment', 'author'], 'safe'],
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
        $query = Clientcirculationcomment::find();

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
            'clientcirculation_id' => $this->clientcirculation_id,
            'state' => $this->state,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'contact_type', $this->contact_type])
            ->andFilterWhere(['like', 'target', $this->target])
            ->andFilterWhere(['like', 'car_model', $this->car_model])
            ->andFilterWhere(['like', 'comment', $this->comment])
            ->andFilterWhere(['like', 'author', $this->author]);

        return $dataProvider;
    }
}