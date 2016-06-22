<?php

namespace app\modules\main\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\main\models\Summertable;

/**
 * SummertableSearch represents the model behind the search form about `app\modules\main\models\Summertable`.
 */
class SummertableSearch extends Summertable
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'price', 'payment'], 'integer'],
            [['model', 'body_color'], 'safe'],
            // [['model', 'body_color', 'discount', 'discount_percent', 'price', 'price_discount', 'payment'], 'required', 'on' => ['create', 'update']],
            // [['name', 'phone', 'selectedcar'], 'required', 'on' => ['testdriverequest']],
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
        $query = Summertable::find();

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
            'discount_percent' => $this->discount_percent,
            'price' => $this->price,
            'payment' => $this->payment,
        ]);

        $query
            ->orFilterWhere(['like', 'model', $this->globalSearch])
            ->orFilterWhere(['like', 'body_color', $this->globalSearch])
            ->orFilterWhere(['like', 'discount_percent', $this->globalSearch])
            ->orFilterWhere(['like', 'discount', $this->globalSearch])
            ->orFilterWhere(['like', 'price_discount', $this->globalSearch])
            ->orFilterWhere(['like', 'payment', $this->globalSearch])
            ->orFilterWhere(['like', 'price', $this->globalSearch])
            ;

        return $dataProvider;
    }
}
