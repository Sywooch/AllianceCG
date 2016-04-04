<?php

namespace app\modules\skoda\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\data\Sort;
use app\modules\skoda\models\Statusmonitor;

/**
 * StatusmonitorSearch represents the model behind the search form about `app\modules\status\models\Statusmonitor`.
 */
class StatusmonitorSearch extends Statusmonitor
{
    public $carstatus;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            ['regnumber', 'safe'],
            [['from', 'to', 'regnumber'], 'safe'],
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
    
    public function rnautocomplete()
    {
        $listdata= Statusmonitor::find()
            ->select(['regnumber as value', 'regnumber as label'])
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
        $query = Statusmonitor::find();

        $sort = new Sort([
            'defaultOrder' => ['to' => SORT_DESC],
            'attributes' => [
                'id',
                'worker',
                'regnumber' => [
                    'asc' => ['regnumber' => SORT_ASC],
                    'desc' => ['regnumber' => SORT_DESC],
                    'label' => 'regnumber',
                    'default' => SORT_ASC
                ],
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
//            'pagination' => [
//                'pageSize' => 10,
//            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            $query->where('0=1');
            return $dataProvider;
        }

        $query
            ->andFilterWhere(['like', 'regnumber', $this->regnumber])
            ->andFilterWhere(['like', 'from', $this->from])
            ->andFilterWhere(['like', 'to', $this->to]);

        return $dataProvider;
    }



    public function getCarWorkStatus() 
    {
        $today = Yii::$app->getFormatter()->asDatetime(time());
        if (strtotime($today) < strtotime($this->from)){
            $carstatus = 'Ожидание';
        }
        elseif (strtotime($today) >= strtotime($this->from) && strtotime($today) < strtotime($this->to)) {
            $carstatus = 'В работе';
        }
        elseif (strtotime($today) >= strtotime($this->to)) {
            $carstatus = 'Готово';
        }

        return $carstatus;
    }  


}
