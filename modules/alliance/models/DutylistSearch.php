<?php

namespace app\modules\alliance\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\alliance\models\Dutylist;
use yii\helpers\Json;

/**
 * DutylistSearch represents the model behind the search form about `app\modules\alliance\models\Dutylist`.
 */
class DutylistSearch extends Dutylist
{

    public $employee;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'employee_id'], 'integer'],
            [['date'], 'safe'],
            [['employee'], 'safe'],
            [['date', 'state', 'stateName', 'globalSearch'], 'safe'],
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
        $query = Dutylist::find();
        $query->joinWith(['employee']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);


        $dataProvider->sort->attributes['employee'] = [
            'asc' => ['{{%employees}}.name' => SORT_ASC],
            'desc' => ['{{%employees}}.name' => SORT_DESC],
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
            'employee_id' => $this->employee_id,
            'date' => $this->date,
        ]);

       $query
            ->orFilterWhere(['like', '{{%employees}}.name', $this->employee])
            ->orFilterWhere(['like', '{{%employees}}.surname', $this->employee])
            ->orFilterWhere(['like', '{{%employees}}.patronimyc', $this->employee])

            ->orFilterWhere(['like', '{{%employees}}.name', $this->globalSearch])
            ->orFilterWhere(['like', '{{%employees}}.surname', $this->globalSearch])
            ->orFilterWhere(['like', '{{%employees}}.patronimyc', $this->globalSearch])

            ->orFilterWhere(['like', '{{%dutylist}}.state', $this->state])            
            ;        

        return $dataProvider;
    }

    public function calendarSearch()
    {
        $calendarQuery = "
            SELECT
                {{%dutylist}}.id
            AS
                id,
            --     {{%dutylist}}.id
            -- AS
            --     url,
                {{%dutylist}}.date
            AS
                start,
                {{%dutylist}}.date
            AS
                end,
            CONCAT
                -- ({{%employees}}.name,' ', {{%employees}}.patronimyc,' ', {{%employees}}.surname) 
                -- ({{%employees}}.name,' ', {{%employees}}.surname)
                ({{%employees}}.surname, ' ', LEFT({{%employees}}.name, 1),'.',LEFT({{%employees}}.patronimyc, 1),'.')
            AS
                title,
            CASE
                WHEN {{%employees}}.photo IS NULL THEN '/img/logo/avatar.jpeg'
                ELSE 
                    CONCAT
                        ('/', {{%employees}}.photo)
                END AS imageurl
            -- CONCAT
            --     ('/', {{%employees}}.photo)

            --     const NO_PHOTO = '@web/img/logo/avatar.jpeg';
            -- AS
            --     imageurl
            FROM
                {{%dutylist}}
            LEFT JOIN 
                {{%employees}}    
            ON
                {{%employees}}.id = {{%dutylist}}.employee_id
            ;
        ";

        $items = Yii::$app->db->createCommand($calendarQuery)->queryAll();       
        
        return Json::encode($items);     
    }
}
