<?php

namespace app\modules\alliance\models;
use app\modules\alliance\Module;

use Yii;
use yii\base\Model;
use yii\data\Sort;
use yii\data\BaseDataProvider;

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
    
    public $ldaphost = "10.18.123.17";
    public $ldapport = 389;
    public $dn = 'ou=addressbook,dc=mail,dc=gorodavto,dc=com';
    public $justthese = ['ou', 'sn', 'cn', 'givenname', 'telephonenumber', 'title', 'mail', 'o'];    
    public $filter    = '(|(telephonenumber=*))';

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
    
    public function search()
    {
        $ds = ldap_connect($this->ldaphost, $this->ldapport) or die("Невозможно соединиться с $this->ldaphost");

        if ($ds) {

            ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);

            $r=ldap_bind($ds);

            $alians=ldap_search($ds, $this->dn, $this->filter, $this->justthese);
            
            $alianskmv = ldap_get_entries($ds, $alians);
            
            ldap_close($ds);    
        }
        
//        $dataProvider = new aseDataProvider([
//            'query' => $alianskmv,
//            'pagination' => false,
//            'sort' => false,
//        ]);        

//        return $dataProvider;
    }

}
