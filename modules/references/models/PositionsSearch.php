<?php

namespace app\modules\references\models;

use Yii;
use yii\data\Sort;
use yii\data\ActiveDataProvider;
use app\modules\references\Module;
use app\modules\admin\models\User;
 
/**
 * This is the model class for table "{{%positions}}".
 *
 * @property integer $id
 * @property string $position
 * @property string $description
 */
class PositionsSearch extends \yii\db\ActiveRecord
{

    public $userscount;
    public $globalSearch;
    public $authorname;

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
            // ['position', 'unique', 'targetClass' => Positions::className(), 'message' => Module::t('module', 'ADMIN_POSITIONS_ERROR_RECORD_EXIST')],
            [['description'], 'string'],
            [['position'], 'string', 'max' => 255],
            [['userscount', 'globalSearch', 'authorname'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Module::t('module', 'ID'),
            'position' => Module::t('module', 'ADMIN_POSITIONS_POSITION'),
            'description' => Module::t('module', 'ADMIN_POSITIONS_DESCRIPTION'),   
            'userscount' => Module::t('module', 'ADMIN_USERS_COUNT'), 
            'globalSearch' => Module::t('module', 'SEARCH'),
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
        $query -> joinWith(['user']);

        // $sort = new Sort([
        //     'attributes' => [
        //         'id',
        //         'position',
        //         'description',
        //         'aurthorname'
        //     ],
        // ]);        

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            // 'sort' => $sort,
        ]);

        $dataProvider->sort->attributes['authorname'] = [
                'asc' => ['{{%user}}.full_name' => SORT_ASC],
                'desc' => ['{{%user}}.full_name' => SORT_DESC],
            ];  

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            $query->where('0=1');
            return $dataProvider;
        }

        $query
            ->andFilterWhere(['like', '{{%positions}}.position', $this->globalSearch]);

        return $dataProvider;
    }
    
    
}
