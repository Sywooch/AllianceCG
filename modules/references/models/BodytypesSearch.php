<?php

namespace app\modules\references\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\references\models\Bodytypes;

/**
 * BodytypesSearch represents the model behind the search form about `app\modules\references\models\Bodytypes`.
 */
class BodytypesSearch extends Bodytypes
{

    public $authorname;

    public $globalSearch;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['body_type', 'description', 'globalSearch', 'authorname'], 'safe'],
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
        $query = Bodytypes::find();
        if(!Yii::$app->user->can('admin')){
            $query->where(['state' => Bodytypes::STATUS_ACTIVE]);
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

        $query
            // ->andFilterWhere(['like', 'body_type', $this->body_type])
            // ->andFilterWhere(['like', 'description', $this->description])
        ->andFilterWhere(['like', 'body_type', $this->globalSearch])
            ;

        return $dataProvider;
    }
}
