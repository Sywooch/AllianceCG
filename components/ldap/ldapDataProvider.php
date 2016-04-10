<?php

/**
 * Component for connect to LDAP-server
 * Need to include this component in config.php (or config-local.php)
 * Host and dn parameters required
 * Anoter parameters can be empty
 * Exaple of configuration:
 *     'components' => [
 *       ...
 *       'ldap' => [
 *           // Parameters 'class' and 'host'required
 *           // 'class' - path to this component
 *           // 'host' - hostname or ip-address of LDAP-server for connect (ldap_connect function)
 *           'class' => 'app\components\ldap\Ldap',
 *           'host' => 'ldap.example.org',
 *           // Parameters 'port', 'rdn' and 'password' can be empty
 *           // If this parameters is empty ldap_bind is anonymous (read only)
 *           // 'port' - port that listen a LDAP-server, if empty - port 389 is used
 *           'port' => '389',
 *           'rdn' => '',
 *           'password' => '',
 *           // 'dn' - Parameter is required for ldap_search function
 *           'dn' => 'ou=addresses,dc=ldap,dc=example,dc=com',
 *           // 'filter' - Parameter for filter base search results
 *           // If this parameter is empty - used '(|(cn=*))' filter value
 *           'filter' => '',
 *           // 'attributes' - Parameter for return in ldap_get_entries. Must be an array
 *           'attributes' => '',
 *       ],  
 *       ...
 *      ],
 */

namespace app\components\ldap;
 
use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
 
class ldapDataProvider extends Component
{
    public $host = '';
    public $port = '';
    public $rdn = '';
    public $password = '';
    public $dn = '';
    public $attributes = '';
    public $filter = '';
    public $ds;
    public $defaultfilter = '(|(cn=*))';
    public $defaultport = '389';
    public $defaultattributes = ['cn'];
    
    public function getFiltervalue()
    {
        return $filterattr = !empty($this->filter) ? $this->filter : $this->defaultfilter;
    }
    
    public function getPortvalue()
    {
        return $connectport = !empty($this->port) ? $this->port : $this->defaultport;
    }
    
    public function getAttributesvalue()
    {
        return $attributesvalue = !empty($this->attributes) ? $this->attributes : $this->defaultattributes;
    }
    
    public function init()
    {
//        echo $this->host . '<br/>';
//        echo $this->port . '<br/>';
//        echo 'F: ' . $this->getPortvalue() . '<br/>';
//        echo $this->rdn . '<br/>';
//        echo $this->password . '<br/>';
//        echo $this->dn . '<br/>';
//        echo $this->filter . '<br/>';
//        echo 'F: ' . $this->getFiltervalue() . '<br/>';
//        print_r($this->attributes) . '<br/>';
//        print_r($this->getAttributesvalue()) . '<br/>';
        
        parent::init();
        
        $ds = ldap_connect($this->host,$this->getPortvalue())
            or die("Unable connect to: " . $this->host);
        
        ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
        
        $r = ldap_bind($ds, $this->rdn, $this->password);
                
        if($r){            
            
            $query = ldap_search($ds, $this->dn, $this->getFiltervalue(), $this->getAttributesvalue());
            
            $result = ldap_get_entries($ds, $query);
            
            $ldap_close = ldap_close($ds);
            
            return 'LDAPconnect: ' . $result["count"];
        }
        else{
            return 'Error!';
        }
    }
    
    public function getCount()
    {
        
    }
 
}