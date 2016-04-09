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
    public $searchfield;
    
    public $ldaphost = "10.18.123.17";
    public $ldapport = 389;

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
        $ds = ldap_connect($this->ldaphost, $this->ldapport) or die("Невозможно соединиться с $this->ldapport");

        if ($ds) {

            ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);

            // Анонимная привязка, доступ только для чтения
            $r=ldap_bind($ds);

            $dn        = 'ou=addressbook,dc=mail,dc=gorodavto,dc=com';
            if(!empty($this->searchfield)){                
                $filter    = '(|(telephonenumber='. $this->searchfield .'))';
            }
            else{                
                $filter    = '(|(telephonenumber=*))';
            }
            $justthese = array('ou', 'sn', 'cn', 'givenname', 'telephonenumber', 'title', 'mail', 'o');    

            $alians=ldap_search($ds, $dn, $filter, $justthese);

            // Получение записей, согласно заданным выше критериям поиска и сортировки
            $alianskmv = ldap_get_entries($ds, $alians);
            
            $totalItemCount = $alianskmv["count"];

            ldap_close($ds);    
        }
                
//        $this->load($params);

        return $totalItemCount;
    }

}
