<?php

namespace app\modules\alliance\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\alliance\models\CreditcalendarComments;

/**
 * CreditcalendarCommentsSearch represents the model behind the search form about `app\modules\alliance\models\CreditcalendarComments`.
 */
class CreditcalendarCommentsSearch extends CreditcalendarComments
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'creditcalendar_id', 'created_at', 'updated_at'], 'integer'],
            [['comment_author', 'comment_text'], 'safe'],
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
        $query = CreditcalendarComments::find();

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
            'creditcalendar_id' => $this->creditcalendar_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'comment_author', $this->comment_author])
            ->andFilterWhere(['like', 'comment_text', $this->comment_text]);

        return $dataProvider;
    }
}
