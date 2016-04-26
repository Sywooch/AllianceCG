<?php

namespace app\modules\alliance\models;
use app\modules\alliance\Module;

use Yii;
use yii\base\Model;
use yii\data\Sort;
use app\components\ldap\ldapDataProvider;

/**
 * PhonebookSearch
 */
class PhonebookSearch extends Model
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
            [['number'], 'integer'],
            [['fullname', 'company', 'department', 'position', 'phone'], 'string'],
            [['number', 'fullname', 'company', 'department', 'position', 'phone'], 'safe'],
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
     * @inheritdoc
     */    
    public function search()
    {        
        $query = Yii::$app->ldap->ldapconnect();
        $filter = Yii::$app->ldap->getFilterValue();
        $attr = Yii::$app->ldap->getAttributesvalue();
        $dn = Yii::$app->ldap->getDn();
                
        $isldapconnect = $query;
        $r = $isldapconnect["0"];
        $ds = $isldapconnect["1"];
        if($isldapconnect){            
            $query = ldap_search($ds, $dn, $filter, $attr);
            $result = ldap_get_entries($ds, $query);
        }
        
        $dataProvider = new ldapDataProvider([
            'query' => $result,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => false,
        ]);
        return $dataProvider;
    }
}
