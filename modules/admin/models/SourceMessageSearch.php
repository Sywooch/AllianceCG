<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\SourceMessage;

/**
 * SourceMessageSearch represents the model behind the search form about `app\modules\admin\models\SourceMessage`.
 */
class SourceMessageSearch extends SourceMessage
{

    public $language;
    public $translation;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['category', 'message'], 'safe'],
            [['language', 'translation'], 'safe']
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
        $query = SourceMessage::find();
        $query->joinWith('messages');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'pagination' => false,
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['language'] = [
            'asc' => ['{{%message}}.language' => SORT_ASC],
            'desc' => ['{{%message}}.language' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['translation'] = [
            'asc' => ['{{%message}}.translation' => SORT_ASC],
            'desc' => ['{{%message}}.translation' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            '{{%source_message}}.id' => $this->id,
        ]);

        $query
            ->andFilterWhere(['like', '{{%source_message}}.id', $this->id])
            ->andFilterWhere(['like', '{{%message}}.language', $this->language])
            ->andFilterWhere(['like', '{{%message}}.translation', $this->translation])
            ->andFilterWhere(['like', 'category', $this->category])
            ->andFilterWhere(['like', 'message', $this->message])
            ;

        return $dataProvider;
    }
}
