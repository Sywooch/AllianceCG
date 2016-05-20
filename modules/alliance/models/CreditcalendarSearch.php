<?php

namespace app\modules\alliance\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\alliance\models\Creditcalendar;
use yii\helpers\Json;
use yii\data\Sort;
use app\modules\alliance\Module;
use yii\helpers\ArrayHelper;

/**
 * CreditcalendarSearch represents the model behind the search form about `app\modules\alliance\models\Creditcalendar`.
 */
class CreditcalendarSearch extends Creditcalendar
{
    public $locations;
    public $responsibles;
    public $authorname;

    /**
     * @inheritdoc
     */

    public $globalSearch;

    public function rules()
    {
        return [
            [['id', 'type', 'allday', 'created_at', 'updated_at', 'status', 'private', 'calendar_type'], 'integer'],
            [['title', 'date_from', 'time_from', 'date_to', 'time_to', 'description', 'author', 'priority'], 'safe'],
            [['locations', 'responsibles', 'calendarcommentscount', 'authorname'], 'safe'],
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
                    {{%calendar}}.status AS status,
                    {{%calendar}}.author AS author,
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
                    {{%user}} 
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
                    {{%calendar}}.status AS status,
                    {{%calendar}}.author AS author,
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
                    CASE allday
                        WHEN '0' THEN 'false'
                        ELSE 'true'
                        END AS allday 
                FROM {{%calendar}}
                WHERE 
                    IF(`private` = '1' AND `author` = '".Yii::$app->user->getId()."', 1, 0) 
                    OR `private`=0;";
        
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
            $query->andWhere(['like', 'user_id', Yii::$app->user->getId()]);
            $query->orFilterWhere(['{{%calendar}}.author' => Yii::$app->user->getId()]);
        }
        else {
            $query->where(['private' => 1]);
            $query->andWhere(['{{%calendar}}.author' => Yii::$app->user->getId()]);
            $query->orWhere(['private' => 0]);
        }
        $query->joinWith(['locations', 'users']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false,
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
            // ->andFilterWhere(['like', 'author', $this->author])
            ->andFilterWhere(['like', '{{%user}}.full_name', $this->authorname])
            ->andFilterWhere(['like', '{{%user}}.full_name', $this->responsibles])
            ->andFilterWhere(['like', '{{%companies}}.company_name', $this->locations]);


        return $dataProvider;
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function personalsearch($params)
    {
        $query = Creditcalendar::find();

        $query->where(['private' => 1]);
        $query->andWhere(['author' => Yii::$app->user->getId()]);

        $query->joinWith(['locations', 'users']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false,
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
