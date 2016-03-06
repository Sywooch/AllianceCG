<?php

namespace app\modules\skoda\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\data\Sort;
use app\modules\skoda\models\Statusmonitor;

/**
 * StatusmonitorSearch represents the model behind the search form about `app\modules\skoda\models\Statusmonitor`.
 */
class MonitorSearch extends Statusmonitor
{


    public $carstatus;
    public $curdatetime;

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

        $time = new \DateTime('now');
        $begin = $time->format('Y-m-d 00:00:00');
        $end = $time->format('Y-m-d 23:59:59');

        $query = Statusmonitor::find()
            ->where(['and',
                    ['>=', 'from', $begin],
                    ['<=', 'from', $end],
                ])
            ->orwhere(['and',                    
                    ['>=', 'to', $begin],
                    ['<=', 'to', $end]
            ]);      

        $sort = new Sort([
            'defaultOrder' => ['to' => SORT_DESC],
            'attributes' => [
                'id',
                'from',
                'to',
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

        return $dataProvider;
    }

}
