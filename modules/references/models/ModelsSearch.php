<?php

namespace app\modules\references\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\references\models\Models;

/**
 * ModelsSearch represents the model behind the search form about `app\modules\references\models\Models`.
 */
class ModelsSearch extends Models
{

    public $brand;
    public $bodytype;
    public $globalSearch;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'brand_id'], 'integer'],
            [['model_name', 'body_type', 'brand', 'globalSearch', 'bodytype'], 'safe'],
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
        $query = Models::find();
        if(!Yii::$app->user->can('admin')){
            $query->where(['{{%models}}.state' => Models::STATUS_ACTIVE]);
        }
        $query->joinWith(['brand', 'bodytype']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['brand'] = [
            'asc' => ['{{%brands}}.brand' => SORT_ASC],
            'desc' => ['{{%brands}}.brand' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['bodytype'] = [
            'asc' => ['{{%bodytypes}}.body_type' => SORT_ASC],
            'desc' => ['{{%bodytypes}}.body_type' => SORT_DESC],
        ];

        $dataProvider->setSort([
            'attributes' => [
                'id',
                'fullmodelname' => [
                    'asc' => ['model_name' => SORT_ASC, '{{%brands}}.brand' => SORT_ASC, '{{%bodytypes}}.body_type' => SORT_ASC],
                    'desc' => ['model_name' => SORT_DESC, '{{%brands}}.brand' => SORT_DESC, '{{%bodytypes}}.body_type' => SORT_DESC],
                    'label' => 'Full Name',
                    'default' => SORT_ASC
                ],
                'state',
            ]
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
            'brand_id' => $this->brand_id,
        ]);

        $query
            ->orFilterWhere(['like', 'model_name', $this->globalSearch])
            ->orFilterWhere(['like', '{{%bodytypes}}.body_type', $this->globalSearch])
            ->orFilterWhere(['like', '{{%brands}}.brand', $this->globalSearch])

            // ->andFilterWhere(['like', 'model_name', $this->model_name])
            // ->andFilterWhere(['like', 'body_type', $this->body_type])
            // ->andFilterWhere(['like', '{{%brands}}.brand', $this->brand])

            // ->andFilterWhere(['like', '{{%bodytypes}}.body_type', $this->body_type])
            ;

        return $dataProvider;
    }
}
