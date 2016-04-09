<?php

namespace app\components\ldap;
 
use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
 
class Ldap extends Component
{
    public $ldaphost = '';
    public $ldapport = '';
    
//    public function init()
//    {
//        parent::init();
//    }    
    
    public function ldapconnect()
    {
        echo $this->ldaphost . '<br/>';
        echo $this->ldapport . '<br/>';
    }
 
}