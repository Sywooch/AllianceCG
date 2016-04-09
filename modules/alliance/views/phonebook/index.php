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

//$ldaphost = "10.18.123.17";
//$ldapport = 389;

?>

<?= $this->render('_search', ['model' => $model]); ?>

<?php

// Соединение с LDAP
$ds = ldap_connect($model->ldaphost, $model->ldapport)
          or die("Невозможно соединиться с $ldaphost");

if ($ds) {
    
    ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
    
    // Анонимная привязка, доступ только для чтения
    $r=ldap_bind($ds);
    
    $dn        = 'ou=addressbook,dc=mail,dc=gorodavto,dc=com';
    if(!empty($model->searchfield)){                
        $filter    = '(|(telephonenumber='. $model->searchfield .'*))';
    }
    else{                
        $filter    = '(|(telephonenumber=*))';
    }    
//    $filter    = '(|(telephonenumber=*))';
    $justthese = array('ou', 'sn', 'cn', 'givenname', 'telephonenumber', 'title', 'mail', 'o');    

    $alians=ldap_search($ds, $dn, $filter, $justthese);
    
//    ldap_sort($ds, $alians, 'sn');
    
    // Получение записей, согласно заданным выше критериям поиска и сортировки
    $alianskmv = ldap_get_entries($ds, $alians);

    // Количество записей
    echo "<b>Показаны записи: " . $model->search() . "</b><br />";

    // Нумерация, начальное значение
    $row_alians = 1;
    
    // Таблица, заголовки таблицы
    echo '<table class="table table-striped">';
    echo '<thead>';
    echo '<th><b>' . $model->getAttributeLabel( 'number' ) . '</b></span></th>';
    echo '<th><b>' . $model->getAttributeLabel( 'fullname' ) . '</b></span></th>';
    echo '<th><b>' . $model->getAttributeLabel( 'company' ) . '</b></span></th>';
    echo '<th><b>' . $model->getAttributeLabel( 'department' ) . '</b></span></th>';
    echo '<th><b>' . $model->getAttributeLabel( 'position' ) . '</b></span></th>';
    echo '<th><b>' . $model->getAttributeLabel( 'phone' ) . '</b></span></th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';     

    // Для каждой, возвращенной записи отображать порядковый номер, Ф.И.О., Отдел, Должность, Рабочий телефон
    for ($i=0; $i<$alianskmv["count"]; $i++) {
        $rows = $row_alians++;

        echo '<tr>';
        
        echo '<td>' . $rows . '.</td>';
        echo '<td>' . $alianskmv[$i]["cn"][0] . '</td>';
        if(isset($alianskmv[$i]["o"][0])){
            echo '<td>' . $alianskmv[$i]["o"][0] . '</td>';            
        } 
        if(isset($alianskmv[$i]["ou"][0])){
            echo '<td>' . $alianskmv[$i]["ou"][0] . '</td>';            
        } 
        if(isset($alianskmv[$i]["title"][0])){
            echo '<td>' . $alianskmv[$i]["title"][0] . '</td>';            
        }
        if(isset($alianskmv[$i]["telephonenumber"][0])){
            echo '<td>' . $alianskmv[$i]["telephonenumber"][0] . '</td>';        
        }
        echo '</tr>';

    }

    echo '</tbody>';
    echo '</table>';    

    // Подчеркивание под таблицей
    echo "<hr />";    
    
    ldap_close($ds);    
}
