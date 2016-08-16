<?php

namespace app\modules\skoda\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\skoda\models\Clients;

/**
 * ClientsSearch represents the model behind the search form about `app\modules\skoda\models\Clients`.
 */
class ClientsSearch extends Clients
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'clientDepartment', 'created_at', 'updated_at'], 'integer'],
            [['clientName', 'clientSurname', 'clientPatronymic', 'clientPhone', 'clientEmail', 'clientBithdayDate', 'clientFullName'], 'safe'],
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
        $query = Clients::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id'=>SORT_DESC]],
            'pagination' => ['pageSize' => 10],
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
            'clientDepartment' => $this->clientDepartment,
            'clientBithdayDate' => $this->clientBithdayDate,
            // 'state' => $this->state,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'clientRegion' => $this->clientRegion,
        ]);

        $query
            // ->andFilterWhere(['like', 'clientName', $this->clientName])
            // ->andFilterWhere(['like', 'clientSurname', $this->clientSurname])
            // ->andFilterWhere(['like', 'clientPatronymic', $this->clientPatronymic])
            ->orFilterWhere(['like', 'clientName', $this->clientFullName])
            ->orFilterWhere(['like', 'clientSurname', $this->clientFullName])
            ->orFilterWhere(['like', 'clientPatronymic', $this->clientFullName])
            ->andFilterWhere(['like', 'clientPhone', $this->clientPhone])
            ->andFilterWhere(['like', 'clientEmail', $this->clientEmail])
            ->andFilterWhere(['like', 'clientRegion', $this->clientRegion])
            // ->andFilterWhere(['like', 'author', $this->author])
            ;

        return $dataProvider;
    }
}
