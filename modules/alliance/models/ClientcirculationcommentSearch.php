<?php

namespace app\modules\alliance\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\alliance\models\Clientcirculationcomment;

/**
 * ClientcirculationcommentSearch represents the model behind the search form about `app\modules\alliance\models\Clientcirculationcomment`.
 */
class ClientcirculationcommentSearch extends Clientcirculationcomment
{

    public $creditmanagers;
    public $salesmanagers;
    public $targets;
    public $contacttypes;
    public $clientname;
    public $authorname;
    public $globalSearch;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'clientcirculation_id', 'state', 'created_at', 'updated_at'], 'integer'],
            [['contact_type', 'target', 'car_model', 'comment', 'author'], 'safe'],
            [['targets', 'contacttypes', 'clientname', 'authorname', 'globalSearch'], 'safe'],
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
        $query = Clientcirculationcomment::find();
        // $query->joinWith(['creditmanagers', 'salesmanagers']);
        $query->joinWith(['creditmanagers', 'targets', 'contacttypes', 'authorname', 'clientcirculation']);
        $query->with(['salesmanagers']);
        if(!Yii::$app->user->can('admin')){
            $query->andFilterWhere(['{{%clientcirculationcomment}}.state' => Clientcirculationcomment::STATUS_ACTIVE]);
        }

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['created_at' => SORT_DESC],
            ],
        ]);

        $dataProvider->sort->attributes['targets'] = [
            'asc' => ['{{%targets}}.target' => SORT_ASC],
            'desc' => ['{{%targets}}.target' => SORT_DESC],
        ];  

        $dataProvider->sort->attributes['contacttypes'] = [
            'asc' => ['{{%contact_type}}.contact_type' => SORT_ASC],
            'desc' => ['{{%contact_type}}.contact_type' => SORT_DESC],
        ];      

        $dataProvider->sort->attributes['authorname'] = [
            'asc' => ['{{%user}}.surname' => SORT_ASC],
            'desc' => ['{{%user}}.surname' => SORT_DESC],
        ];                      

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        // $query->andFilterWhere([
        //     'id' => $this->id,
        //     'clientcirculation_id' => $this->clientcirculation_id,
        //     'state' => $this->state,
        //     'created_at' => $this->created_at,
        //     'updated_at' => $this->updated_at,
        // ]);

        $query
            // ->orFilterWhere(['like', 'contact_type', $this->globalSearch])
            // ->orFilterWhere(['like', 'target', $this->globalSearch])
            ->orFilterWhere(['like', '{{%client_circulation}}.name', $this->globalSearch])
            ->orFilterWhere(['like', '{{%targets}}.target', $this->globalSearch])
            ->orFilterWhere(['like', '{{%contact_type}}.contact_type', $this->globalSearch])
            ->orFilterWhere(['like', 'car_model', $this->globalSearch])
            ->orFilterWhere(['like', '{{%user}}.surname', $this->globalSearch])
            ->andFilterWhere(['like', "FROM_UNIXTIME({{%clientcirculationcomment}}.created_at)", $this->comment])
            ->andFilterWhere(['like', "FROM_UNIXTIME({{%clientcirculationcomment}}.updated_at)", $this->comment])             
            // ->andFilterWhere(['like', 'contact_type', $this->contact_type])
            // ->andFilterWhere(['like', 'target', $this->target])
            // ->andFilterWhere(['like', '{{%targets}}.target', $this->targets])
            // ->andFilterWhere(['like', '{{%contact_type}}.contact_type', $this->contacttypes])
            // ->andFilterWhere(['like', 'car_model', $this->car_model])
            // ->andFilterWhere(['like', '{{%user}}.surname', $this->authorname])
            // ->andFilterWhere(['like', "FROM_UNIXTIME({{%clientcirculationcomment}}.created_at)", $this->comment])
            // ->andFilterWhere(['like', "FROM_UNIXTIME({{%clientcirculationcomment}}.updated_at)", $this->comment])            
            ;

        return $dataProvider;
    }
}
