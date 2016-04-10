<?php

namespace app\modules\alliance\models;
use app\modules\alliance\Module;

use Yii;
use yii\base\Model;
use yii\data\Sort;
use yii\data\BaseDataProvider;
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
    
//    public $ldaphost = "10.18.123.17";
//    public $ldapport = 389;
//    public $dn = 'ou=addressbook,dc=mail,dc=gorodavto,dc=com';
//    public $justthese = ['ou', 'sn', 'cn', 'givenname', 'telephonenumber', 'title', 'mail', 'o'];    
//    public $filter    = '(|(telephonenumber=*))';

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['number'], 'integer'],
            [['fullname', 'company', 'department', 'position', 'phone'], 'string'],
            [['fullname', 'company', 'department', 'position', 'phone'], 'safe'],
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
        
//        return $result;
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
