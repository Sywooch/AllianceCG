<?php

namespace app\modules\alliance\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\alliance\models\Creditcalendar;
use yii\helpers\Json;
use yii\data\Sort;

/**
 * CreditcalendarSearch represents the model behind the search form about `app\modules\alliance\models\Creditcalendar`.
 */
class CreditcalendarSearch extends Creditcalendar
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['id', 'type', 'is_repeat', 'created_at'], 'integer'],
            [['id', 'type', 'created_at'], 'integer'],
            [['title', 'date_from', 'time_from', 'date_to', 'time_to', 'responsible', 'description', 'location', 'author', 'status'], 'safe'],
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
    
    public function authorautocomplete()
    {
        $listdata= Creditcalendar::find()
            ->select(['author as value', 'author as label'])
            ->asArray()
            ->all();
        return $listdata;
    }
    
    public function calendarsearch(){
        
        if(Yii::$app->user->can('seniorcreditspesialist'))
        {        
            $items = Yii::$app->db->createCommand(
                "SELECT
                    `id` AS id,
                    `id` AS url,
                    -- `location` AS location,
                    CASE 
                        WHEN CONCAT(date_from, ' ', time_from) IS NULL THEN time_to
                        ELSE CONCAT(date_from, ' ', time_from)
                        END AS start,
                    CASE
                        WHEN CONCAT(date_to, ' ', time_to) IS NULL THEN time_to
                        ELSE CONCAT(date_to, ' ', time_to)
                        END AS end,
                    `title` AS title,
                    CASE status
                        WHEN '0' THEN 'red'
                        WHEN '1' THEN 'primary'
                        ELSE 'green'
                        END as color,
                    -- CASE dow
                    --     WHEN dow IS NULL THEN false
                    --     ELSE dow
                    --     END AS dow,
                    CASE allday
                        WHEN '0' THEN 'false'
                        ELSE 'true'
                        END AS allday 
                FROM {{%calendar}};"
            )->queryAll();
        }
        else
        {        
            $items = Yii::$app->db->createCommand(
                "SELECT
                    `id` AS id,
                    `id` AS url,
                    CASE 
                        WHEN CONCAT(date_from, ' ', time_from) IS NULL THEN time_to
                        ELSE CONCAT(date_from, ' ', time_from)
                        END AS start,
                    CASE
                        WHEN CONCAT(date_to, ' ', time_to) IS NULL THEN time_to
                        ELSE CONCAT(date_to, ' ', time_to)
                        END AS end,
                    `title` AS title,
                    CASE status
                        WHEN '0' THEN 'red'
                        WHEN '1' THEN 'primary'
                        ELSE 'green'
                        END as color,
                    -- CASE dow
                    --     WHEN dow IS NULL THEN false
                    --     ELSE dow
                    --     END AS dow,
                    CASE allday
                        WHEN '0' THEN 'false'
                        ELSE 'true'
                        END AS allday 
                FROM {{%calendar}} WHERE `private` <> '1';"
            )->queryAll();
        }        
        
        return Json::encode($items);
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
        if(Yii::$app->user->can('seniorcreditspesialist'))
        {
            $query = Creditcalendar::find();
        }
        else
        {
            $query = Creditcalendar::find()
                ->where(['<>','private', 1])
                // ->andWhere(['<>','author', Yii::$app->user->getID()])
                ;
        }
                

        // add conditions that should always apply here

        $sort = new Sort([
            'attributes' => [
                'id',
                'title',
                'date_from',
                'date_to',
                'location',
                'type',
                'responsible',  
                'status',
                'author',
                'dateTimeFrom' => [
                    'asc' => ['date_from' => SORT_ASC, 'time_from' => SORT_ASC],
                    'desc' => ['date_from' => SORT_DESC, 'time_from' => SORT_DESC],
                    'label' => 'dateTimeFrom',
                    'default' => SORT_ASC
                ],
                'dateTimeTo' => [
                    'asc' => ['date_to' => SORT_ASC, 'time_to' => SORT_ASC],
                    'desc' => ['date_to' => SORT_DESC, 'time_to' => SORT_DESC],
                    'label' => 'dateTimeTo',
                    'default' => SORT_DESC,
                ],
            ],
            'defaultOrder' => [
                'dateTimeTo' => SORT_DESC,
            ],
        ]);                

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => $sort,
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
            'date_from' => $this->date_from,
            'time_from' => $this->time_from,
            'date_to' => $this->date_to,
            'time_to' => $this->time_to,
            'type' => $this->type,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'responsible', $this->responsible])
            ->andFilterWhere(['like', 'location', $this->location])
            ->andFilterWhere(['like', 'author', $this->author])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['>=', 'date_from', $this->dateTimeFrom ? strtotime($this->date_from) : null])
            ->andFilterWhere(['<=', 'date_to', $this->dateTimeTo ? strtotime($this->date_to . ' ' . $this->time_to) : null])
                ;

        return $dataProvider;
    }
}
