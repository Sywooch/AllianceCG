<?php

namespace app\modules\references\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\references\models\Regions;

/**
 * RegionsSearch represents the model behind the search form about `app\modules\references\models\Regions`.
 */
class RegionsSearch extends Regions
{
    public $globalSearch;
    public $authorname;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'region_code', 'state', 'created_at', 'updated_at'], 'integer'],
            [['region_name', 'author'], 'safe'],
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
        $query = Regions::find();
        if(!Yii::$app->user->can('admin')){
            $query->where(['state' => Regions::STATUS_ACTIVE]);
        }

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false,
            'sort'=> ['defaultOrder' => ['regionandcodes'=>SORT_ASC]]
        ]);

        $dataProvider->sort->attributes['authorname'] = [
            'asc' => ['{{%user}}.full_name' => SORT_ASC],
            'desc' => ['{{%user}}.full_name' => SORT_DESC],
        ];

        $dataProvider->setSort([
            'attributes'=>[
                'id',
                'regionandcodes'=>[
                    'asc'=>['region_name'=>SORT_ASC, 'region_code'=>SORT_ASC],
                    'desc'=>['region_name'=>SORT_DESC, 'region_code'=>SORT_DESC],
                    'label'=>'regionandcodes',
                    'default'=>SORT_ASC
                ],
                'authorname',
                'created_at',
                'updated_at',
                'author',
                'state' => [
                    'asc' => ['state'=>SORT_ASC],
                    'desc' => ['state' => SORT_DESC],
                ],
                'defaultOrder' => [
                    'regionandcodes' => SORT_DESC,
                ],
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
            'region_code' => $this->region_code,
            'state' => $this->state,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query
            // ->andFilterWhere(['like', 'region_name', $this->region_name])
            // ->andFilterWhere(['like', 'author', $this->author])
            ->orFilterWhere(['like', 'region_name', $this->globalSearch])
            ->orFilterWhere(['like', 'region_code', $this->globalSearch])
            ;

        return $dataProvider;
    }
}
