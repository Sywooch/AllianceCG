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
            [['regnumber'], 'string', 'max' => 255],
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
                'regnumber',
                'worker',
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
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            $query->where('0=1');
            return $dataProvider;
        }

        $query
            ->andFilterWhere(['like', 'from', $this->from])
            ->andFilterWhere(['like', 'to', $this->to])
            // ->andFilterWhere(['>=', 'from', $this->from ? strtotime($this->from . ' 00:00:00') : null])
            // ->andFilterWhere(['<=', 'to', $this->to ? strtotime($this->to . ' 23:59:59') : null])
            ->andFilterWhere(['like', 'regnumber', $this->regnumber]);

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
