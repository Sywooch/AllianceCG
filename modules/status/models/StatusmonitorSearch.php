<?php

namespace app\modules\status\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\data\Sort;
use app\modules\status\models\Statusmonitor;

/**
 * StatusmonitorSearch represents the model behind the search form about `app\modules\status\models\Statusmonitor`.
 */
class StatusmonitorSearch extends Statusmonitor
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status'], 'integer'],
            [['regnumber', 'responsible'], 'string', 'max' => 255],
            [['from', 'to', 'responsible', 'regnumber'], 'safe'],
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
        $query = Statusmonitor::find();

        $sort = new Sort([
            'defaultOrder' => ['id' => SORT_DESC],
            'attributes' => [
                'id',
                'regnumber',
                'responsible',
                'from' => [
                    'asc' => ['from' => SORT_ASC],
                    'desc' => ['from' => SORT_DESC],
                    'label' => 'from',
                    'default' => SORT_ASC
                ],
                'to' => [
                    'asc' => ['to' => SORT_ASC],
                    'desc' => ['to' => SORT_DESC],
                    'label' => 'to',
                    'default' => SORT_ASC
                ],
            ],
        ]);       

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => $sort,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        // $query->andFilterWhere([
        //     'id' => $this->id,
        //     'regnumber' => $this->regnumber,
        //     'from' => $this->from,
        //     'to' => $this->to,
        //     'status' => $this->status,
        // ]);

        $query
            ->andFilterWhere(['like', 'responsible', $this->responsible])
            ->andFilterWhere(['like', 'regnumber', $this->regnumber]);

        return $dataProvider;
    }
}
