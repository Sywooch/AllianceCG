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

public function calendarsearch(){

        $creditmanagerquery = 
                "SELECT
                    {{%calendar}}.id AS id,
                    {{%calendar}}.id AS url,
                    CASE 
                        WHEN CONCAT({{%calendar}}.date_from, ' ', {{%calendar}}.time_from) IS NULL THEN {{%calendar}}.time_to
                        ELSE CONCAT({{%calendar}}.date_from, ' ', {{%calendar}}.time_from)
                        END AS start,
                    CASE
                        WHEN CONCAT({{%calendar}}.date_to, ' ', {{%calendar}}.time_to) IS NULL THEN {{%calendar}}.time_to
                        ELSE CONCAT({{%calendar}}.date_to, ' ', {{%calendar}}.time_to)
                        END AS end,
                    {{%calendar}}.title AS title,
                    CASE {{%calendar}}.status
                        WHEN '0' THEN 'red'
                        WHEN '1' THEN 'primary'
                        ELSE 'green'
                        END as color,
                    CASE {{%calendar}}.allday
                        WHEN '0' THEN 'false'
                        ELSE 'true'
                        END AS allday   
                FROM
                    {{%calendar}} 
                LEFT JOIN
                    {{%calendar_responsibles}} 
                ON 
                    {{%calendar_responsibles}}.calendar_id = {{%calendar}}.id
                LEFT JOIN 
                    all_user 
                ON
                    {{%calendar_responsibles}}.user_id = {{%user}}.id 
                WHERE 
                    author = '".Yii::$app->user->getId()."'
                OR 
                    {{%calendar_responsibles}}.user_id LIKE '".Yii::$app->user->getId()."'
                AND 
                    {{%calendar}}.private <> 1;";

        $chiefcreditquery = 
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
                FROM {{%calendar}};";
        
        $query = !Yii::$app->user->can('creditmanager') ? $chiefcreditquery : $creditmanagerquery;

        $items = Yii::$app->db->createCommand($query)->queryAll();       
        
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
        $query = Creditcalendar::find();
        if(Yii::$app->user->can('creditmanager')){        
            $query->where(['<>','private', 1]);
            // $query->andWhere(['']);            
        }
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
