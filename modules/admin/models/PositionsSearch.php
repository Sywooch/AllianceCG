<?php

namespace app\modules\admin\models;

use Yii;
use yii\data\Sort;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "{{%positions}}".
 *
 * @property integer $id
 * @property string $position
 * @property string $description
 */
class PositionsSearch extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%positions}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // [['position', 'description'], 'required'],
            ['position', 'unique', 'targetClass' => Positions::className(), 'message' => Yii::t('app', 'ADMIN_POSITIONS_ERROR_RECORD_EXIST')],
            [['description'], 'string'],
            [['position'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'position' => Yii::t('app', 'ADMIN_POSITIONS_POSITION'),
            'description' => Yii::t('app', 'ADMIN_POSITIONS_DESCRIPTION'),
        ];
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
        $query = Positions::find();

        $sort = new Sort([
            'attributes' => [
                'id',
                'position',
                'description',
            ],
        ]);        

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => $sort,
            // 'sort' => [
            //     'defaultOrder' => ['id' => SORT_DESC],
            //     // 'attributes' => ['username','email','status'],
            // ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            $query->where('0=1');
            return $dataProvider;
        }
        
        $query
            ->andFilterWhere(['like', 'position', $this->position]);

        return $dataProvider;
    }
    
    
}
