<?php

namespace app\modules\references\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\User;
use app\modules\references\models\Brands;

/**
 * BrandsSearch represents the model behind the search form about `app\modules\references\models\Brands`.
 */
class BrandsSearch extends Brands
{

    public $globalSearch;
    public $authorname;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'state'], 'integer'],
            [['brand', 'brand_logo', 'description'], 'safe'],
            [['globalSearch', 'authorname'], 'safe'],
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
        $query = Brands::find();
        if(!Yii::$app->user->can('admin')){
            $query->where(['state' => Brands::STATUS_ACTIVE]);
        }
        $query->joinWith(['authorname']);

        $dataProvider->sort->attributes['authorname'] = [
            'asc' => ['{{%user}}.full_name' => SORT_ASC],
            'desc' => ['{{%user}}.full_name' => SORT_DESC],
        ];

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
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
            'state' => $this->state,
        ]);

        // $query->andFilterWhere(['like', 'brand', $this->brand]);
        $query->orFilterWhere(['like', 'brand', $this->globalSearch]);
        $query->andFilterWhere(['like', '{{%user}}.full_name', $this->authorname]);

        return $dataProvider;
    }
}
