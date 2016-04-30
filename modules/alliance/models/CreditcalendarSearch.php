<?php

namespace app\modules\alliance\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\alliance\models\Creditcalendar;

/**
 * CreditcalendarSearch represents the model behind the search form about `app\modules\alliance\models\Creditcalendar`.
 */
class CreditcalendarSearch extends Creditcalendar
{
    public $locations;

    /**
     * @inheritdoc
     */

    public $globalSearch;

    public function rules()
    {
        return [
            [['id', 'type', 'allday', 'created_at', 'updated_at', 'status', 'private', 'calendar_type'], 'integer'],
            [['title', 'date_from', 'time_from', 'date_to', 'time_to', 'description', 'author', 'globalSearch'], 'safe'],
            ['locations', 'safe'],
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

    public function titleautocomplete()
    {
        $listdata= Creditcalendar::find()
            ->select(['title as value', 'title as label'])
            ->asArray()
            ->all();
        return $listdata;
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
        $query = Creditcalendar::find();
        $query->joinWith(['locations', 'users']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['locations'] = [
            'asc' => ['{{%companies}}.company_name' => SORT_ASC],
            'desc' => ['{{%companies}}.company_name' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['responsibles'] = [
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
            'date_from' => $this->date_from,
            'time_from' => $this->time_from,
            'date_to' => $this->date_to,
            'time_to' => $this->time_to,
            'type' => $this->type,
            'allday' => $this->allday,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'status' => $this->status,
            'private' => $this->private,
            'calendar_type' => $this->calendar_type,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['>=', 'date_from', $this->date_from])
            ->andFilterWhere(['>=', 'date_to', $this->date_to])
            ->andFilterWhere(['like', 'author', $this->author]);


        return $dataProvider;
    }
}
