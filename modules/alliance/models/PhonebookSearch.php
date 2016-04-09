<?php

namespace app\modules\alliance\models;
use app\modules\alliance\Module;

use Yii;
use yii\base\Model;
use yii\data\Sort;

/**
 * StatusmonitorSearch represents the model behind the search form about `app\modules\skoda\models\Statusmonitor`.
 */
class PhonebookSearch extends \yii\db\ActiveRecord
{
    public $number;
    public $fullname;
    public $company;
    public $department;
    public $position;
    public $phone;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'number' => Module::t('module', 'PHONEBOOK_NUMBER'),
            'fullname' => Module::t('module', 'PHONEBOOK_FULLNAME'),
            'company' => Module::t('module', 'PHONEBOOK_COMPANY'),
            'department' => Module::t('module', 'PHONEBOOK_DEPARTMENT'),
            'position' => Module::t('module', 'PHONEBOOK_POSITION'),
            'phone' => Module::t('module', 'PHONEBOOK_PHONE'),
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
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => $sort,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            $query->where('0=1');
            return $dataProvider;
        }

        return $dataProvider;
    }

}
