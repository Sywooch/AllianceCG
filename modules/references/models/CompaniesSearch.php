<?php

namespace app\modules\references\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\references\models\Companies;

/**
 * CompaniesSearch represents the model behind the search form about `app\modules\references\models\Companies`.
 */
class CompaniesSearch extends Companies
{

    public $brandlogo;
    public $globalSearch;
    public $user;
    public $usercount;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['brandlogo'], 'safe'],
            [['company_name', 'company_brand', 'company_logo', 'company_description', 'brandlogo'], 'safe'],
            [['globalSearch', 'user', 'usercount'], 'safe'],
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
        $query = Companies::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query
            ->orFilterWhere(['like', 'company_name', $this->globalSearch])
            ->orFilterWhere(['like', 'company_brand', $this->globalSearch])
            ->orFilterWhere(['like', 'company_logo', $this->globalSearch])
            ->orFilterWhere(['like', 'company_description', $this->globalSearch])
        ;

        // $query->andFilterWhere(['like', 'company_name', $this->company_name])
        //     ->andFilterWhere(['like', 'company_brand', $this->company_brand])
        //     ->andFilterWhere(['like', 'company_logo', $this->company_logo])
        //     ->andFilterWhere(['like', 'company_description', $this->company_description]);

        return $dataProvider;
    }
}
