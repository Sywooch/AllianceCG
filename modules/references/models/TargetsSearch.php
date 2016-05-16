<?php

namespace app\modules\references\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\references\models\Targets;

/**
 * TargetsSearch represents the model behind the search form about `app\modules\references\models\Targets`.
 */
class TargetsSearch extends Targets
{

    public $globalSearch;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['target', 'globalSearch', 'state'], 'safe'],
            [['target'], 'unique'],
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
        $query = Targets::find();
        if(!Yii::$app->user->can('admin')){
            $query->where(['state' => Targets::STATUS_ACTIVE]);
        }

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
        ]);

        // $query->andFilterWhere(['like', 'target', $this->target]);
        $query->orFilterWhere(['like', 'target', $this->globalSearch]);

        return $dataProvider;
    }
}
