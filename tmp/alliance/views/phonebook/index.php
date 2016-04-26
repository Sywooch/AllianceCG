<?php
    use app\modules\alliance\Module;
    use app\modules\alliance\models\PhonebookSearch;
    use rmrevin\yii\fontawesome\FA;
    use yii\grid\GridView;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$this->title = Module::t('module', 'NAV_ALLIANCE_PHONEBOOK');
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'NAV_ALLIANCE'), 'url' => ['/alliance']];
$this->params['breadcrumbs'][] = $this->title;   

print_r($model->attributeLabels());

?>

<?php 
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            
            'number',
            [
                'attribute' => 'fullname',
                'format' => 'raw',
            ],
            'fullname',
            'position',
            'company',
            'department',
            'phone',
 
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); 
?>



<?php

//var_dump($model->search());

//$ds = ldap_connect($model->ldaphost, $model->ldapport)
//          or die("Невозможно соединиться с $ldaphost");
//
//if ($ds) {
//    
//    $ldapuser = 'cn=root,dc=mail,dc=gorodavto,dc=com';
//    $ldappassword = 'Rjkj,jr1';
//    
//    ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
//    $r=ldap_bind($ds, $ldapuser, $ldappassword);
//    
//    $dn        = 'ou=addressbook,dc=mail,dc=gorodavto,dc=com';
//    
//    $filter    = '(|(telephonenumber=*))';
//    
//    $defaultfilter = '(|(cn=*))';
//    if (!empty($filter)){
//        $filterattr = $filter;
//    }
//    else{
//        $filterattr = $defaultfilter;
//    }
//    
//    $searchattr = ['ou', 'sn', 'cn', 'givenname', 'telephonenumber', 'title', 'mail', 'o'];    
//
//    $alians=ldap_search($ds, $dn, $filterattr, $searchattr);
//    
//    $alianskmv = ldap_get_entries($ds, $alians);
//
//    echo "<b>Показаны записи: " . $alianskmv["count"] . "</b><br />";
//
//    $row_alians = 1;
//
//    echo '<table class="table table-striped">';
//    echo '<thead>';
//    echo '<th><b>' . $model->getAttributeLabel( 'number' ) . '</b></span></th>';
//    echo '<th><b>' . $model->getAttributeLabel( 'fullname' ) . '</b></span></th>';
//    echo '<th><b>' . $model->getAttributeLabel( 'company' ) . '</b></span></th>';
//    echo '<th><b>' . $model->getAttributeLabel( 'department' ) . '</b></span></th>';
//    echo '<th><b>' . $model->getAttributeLabel( 'position' ) . '</b></span></th>';
//    echo '<th><b>' . $model->getAttributeLabel( 'phone' ) . '</b></span></th>';
//    echo '</tr>';
//    echo '</thead>';
//    echo '<tbody>';     
//    
//    for ($i=0; $i<$alianskmv["count"]; $i++) {
//        $rows = $row_alians++;
//
//        echo '<tr>';
//        
//        echo '<td>' . $rows . '.</td>';
//        echo '<td>' . $alianskmv[$i]["cn"][0] . '</td>';
//        if(isset($alianskmv[$i]["o"][0])){
//            echo '<td>' . $alianskmv[$i]["o"][0] . '</td>';            
//        } 
//        if(isset($alianskmv[$i]["ou"][0])){
//            echo '<td>' . $alianskmv[$i]["ou"][0] . '</td>';            
//        } 
//        if(isset($alianskmv[$i]["title"][0])){
//            echo '<td>' . $alianskmv[$i]["title"][0] . '</td>';            
//        }
//        if(isset($alianskmv[$i]["telephonenumber"][0])){
//            echo '<td>' . $alianskmv[$i]["telephonenumber"][0] . '</td>';        
//        }
//        echo '</tr>';
//
//    }
//
//    echo '</tbody>';
//    echo '</table>';    
//    
//    ldap_close($ds);    
//}
