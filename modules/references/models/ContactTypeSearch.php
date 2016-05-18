<?php

namespace app\modules\references\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\references\models\ContactType;

/**
 * ContactTypeSearch represents the model behind the search form about `app\modules\references\models\ContactType`.
 */
class ContactTypeSearch extends ContactType
{
    
    public $authorname;
    public $globalSearch;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'state', 'created_at', 'updated_at'], 'integer'],
            [['contact_type', 'author', 'authorname', 'globalSearch'], 'safe'],
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
        $query = ContactType::find();
        $query->joinWith('authorname');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['authorname'] = [
            'asc' => ['{{%user}}.full_name' => SORT_ASC],
            'desc' => ['{{%user}}.full_name' => SORT_DESC],
        ];

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
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query
            // ->andFilterWhere(['like', 'contact_type', $this->contact_type])
            // ->andFilterWhere(['like', 'author', $this->author])
            ->andFilterWhere(['like', 'contact_type', $this->globalSearch])
            ;

        return $dataProvider;
    }
}
