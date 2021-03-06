<?php

namespace app\modules\alliance\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\alliance\models\ClientCirculation;
use app\modules\references\models\Employees;

/**
 * ClientCirculationSearch represents the model behind the search form about `app\modules\alliance\models\ClientCirculation`.
 */
class ClientCirculationSearch extends ClientCirculation
{

    public $authorname;
    public $regions;
    public $comment;
    public $globalSearch;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'state', 'created_at', 'updated_at', 'region_id'], 'integer'],
            [['name', 'phone', 'email', 'author'], 'safe'],
            [['authorname', 'regions'], 'safe'],
            [['comment', 'globalSearch'], 'safe']
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
        $query = ClientCirculation::find();
        if(!Yii::$app->user->can('admin')){
            $query->where(['{{%client_circulation}}.state' => ClientCirculation::STATUS_ACTIVE]);
        }
        $query->joinWith(['authorname', 'regions', 'clientcomment']);

        // add conditions that should always apply here           

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
                'attributes' => [
                    'name' => [
                        'asc' => ['name' => SORT_ASC],
                        'desc' => ['name' => SORT_DESC],
                    ],
                    'phone',
                    'email',
                    'created_at' => [
                        'asc' =>    [ '{{%clientcirculationcomment}}.created_at' => SORT_ASC ],
                        'desc' =>   [ '{{%clientcirculationcomment}}.created_at' => SORT_DESC ],
                        'label' => 'created_at'
                    ],                 
                ],
                'defaultOrder' => ['created_at' => SORT_DESC],
           ]);             

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $dataProvider->sort->attributes['authorname'] = [
            'asc' => ['{{%user}}.full_name' => SORT_ASC],
            'desc' => ['{{%user}}.full_name' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['regions'] = [
                'asc' => ['{{%regions}}.region_name' => SORT_ASC],
                'desc' => ['{{%regions}}.region_name' => SORT_DESC],
            ]; 

        // grid filtering conditions
        // $query->andFilterWhere([
        //     'id' => $this->id,
        //     'state' => $this->state,
        //     'created_at' => $this->created_at,
        //     'updated_at' => $this->updated_at,
        //     'region_id' => $this->region_id,
        // ]);

        $query
            ->orFilterWhere(['like', '{{%client_circulation}}.name', $this->globalSearch])
            ->orFilterWhere(['like', '{{%client_circulation}}.phone', $this->globalSearch])
            ->orFilterWhere(['like', '{{%client_circulation}}.email', $this->globalSearch])
            ->orFilterWhere(['like', '{{%regions}}.region_name', $this->globalSearch])
            ->orFilterWhere(['like', '{{%regions}}.region_code', $this->globalSearch])
            ->orFilterWhere(['like', '{{%client_circulation}}.author', $this->globalSearch])
            ->orFilterWhere(['and', ['like', "FROM_UNIXTIME({{%clientcirculationcomment}}.created_at)", $this->comment ? $this->comment : null], ['{{%clientcirculationcomment}}.state' =>  Clientcirculationcomment::STATUS_ACTIVE]])
            ->orFilterWhere(['and', ['like', "FROM_UNIXTIME({{%clientcirculationcomment}}.updated_at)", $this->comment ? $this->comment : null], ['{{%clientcirculationcomment}}.state' =>  Clientcirculationcomment::STATUS_ACTIVE]])

            // ->andFilterWhere(['like', '{{%client_circulation}}.name', $this->name])
            // ->andFilterWhere(['like', '{{%client_circulation}}.phone', $this->phone])
            // ->andFilterWhere(['like', '{{%client_circulation}}.email', $this->email])
            // ->andFilterWhere(['like', '{{%user}}.full_name', $this->authorname])
            // ->andFilterWhere(['like', '{{%regions}}.region_name', $this->regions])
            // ->orFilterWhere(['like', '{{%regions}}.region_code', $this->regions])
            // ->andFilterWhere(['like', '{{%client_circulation}}.author', $this->author])
            // ->andFilterWhere(['and', ['like', "FROM_UNIXTIME({{%clientcirculationcomment}}.created_at)", $this->comment], ['{{%clientcirculationcomment}}.state' =>  Clientcirculationcomment::STATUS_ACTIVE]])
            // ->andFilterWhere(['and', ['like', "FROM_UNIXTIME({{%clientcirculationcomment}}.updated_at)", $this->comment], ['{{%clientcirculationcomment}}.state' =>  Clientcirculationcomment::STATUS_ACTIVE]])
            // ->andFilterWhere(['like', "FROM_UNIXTIME({{%clientcirculationcomment}}.updated_at)", $this->comment])
            // ->andFilterWhere(['{{%clientcirculationcomment}}.created_at' => date('yyyy-mm-dd',strtotime($this->comment))])
            ;

        return $dataProvider;
    }
}