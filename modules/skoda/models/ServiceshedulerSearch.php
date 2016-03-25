<?php

namespace app\modules\skoda\models;

use Yii;
use yii\base\Model;
use app\modules\skoda\Module;
use yii\data\ActiveDataProvider;
use yii\data\Sort;
use app\modules\skoda\models\Servicesheduler;

/**
 * ServiceshedulerSearch represents the model behind the search form about `app\modules\skoda\models\Servicesheduler`.
 */
class ServiceshedulerSearch extends Servicesheduler
{

    public $date_from;
    public $date_to;
    public $events;
    public $tasks;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['responsible'], 'string'],
            [['date_from', 'date_to'], 'safe'],
            [['date'], 'safe'],
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
        $query = Servicesheduler::find();


        $sort = new Sort([
            'defaultOrder' => ['date' => SORT_DESC],
            'attributes' => [
                'id',
                'date',
                'responsible',
            ],
        ]);          

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => $sort,         
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // $query->andFilterWhere([
        //     'id' => $this->id,
        //     'date' => $this->date,
        //     'responsible' => $this->responsible,
        // ]);

        $query
            ->andFilterWhere(['like', 'responsible', $this->responsible])
            ->andFilterWhere(['>=', 'date', $this->date_from])
            ->andFilterWhere(['<=', 'date', $this->date_to])
            // ->andFilterWhere(['>=', 'date', $this->date_from ? strtotime($this->date_from) : null])
            // ->andFilterWhere(['<=', 'date', $this->date_to ? strtotime($this->date_to) : null])
            ->andFilterWhere(['like', 'date', $this->date]);

        return $dataProvider;
    }
}
