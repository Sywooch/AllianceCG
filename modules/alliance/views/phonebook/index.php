<?php
    use app\modules\alliance\Module;
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

$ldaphost = "10.18.123.17";         // Ваш сервер ldap
$ldapport = 389;                    // Порт вашего сервера ldap

// Соединение с LDAP
$ds = ldap_connect($ldaphost, $ldapport)
          or die("Невозможно соединиться с $ldaphost");

//$ds=ldap_connect("10.18.123.17");

if ($ds) {
    
    ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
    
    // Анонимная привязка, доступ только для чтения
    $r=ldap_bind($ds);

    // ООО Альянс
    // Аттрибуты поиска, подразделение alians-kmv, наличие аттрибута телефон (telephonenumber)
//    $alians=ldap_search($ds, "ou=alians-kmv.ru,ou=addressbook,dc=mail,dc=gorodavto,dc=com", "telephonenumber=*");
    $alians=ldap_search($ds, "ou=addressbook,dc=mail,dc=gorodavto,dc=com", "telephonenumber=*");

    // Сортировка, критерий отдел (в данном представлении ldap-аттрибут "ou")
//    ldap_get_entries($ds, $alians);

    // Получение записей, согласно заданным выше критериям поиска и сортировки
    $alianskmv = ldap_get_entries($ds, $alians);

    // Заголовок таблицы
    echo "<b>ООО Альянс </b><br />";

    // Количество записей
    echo "<b>Записей: " . $alianskmv["count"] . "</b><br />";

    // Нумерация, начальное значение
    $row_alians = 1;
    
//    print_r($alianskmv);

    // Таблица, заголовки таблицы
//    echo '<table class="table table-striped">';
//    echo '<thead>';
//    echo '<th><b>№</b></span></th>';
//    echo '<th><b> Ф.И.О </b></span></th>';
//    echo '<th><b> Отдел </b></span></th>';
////    echo '<th><b> Должность </b></span></th>';
//    echo '<th><b> Рабочий телефон </b></span></th>';
//    echo '</tr>';
//    echo '</thead>';
//    echo '<tbody>';     
//
//    // Для каждой, возвращенной записи отображать порядковый номер, Ф.И.О., Отдел, Должность, Рабочий телефон
//    for ($i=0; $i<$alianskmv["count"]; $i++) {
//        $rows = $row_alians++;
//
//        echo '<tr>';
//        
//        echo '<td>' . $rows . '.</td>';
//        echo '<td>' . $alianskmv[$i]["cn"][0] . '</td>';
//        echo '<td>' . $alianskmv[$i]["ou"][0] . '</td>';
////        echo '<td>' . $alianskmv[$i]["title"][0] . '</td>';
//        echo '<td>' . $alianskmv[$i]["telephonenumber"][0] . '</td>';        
//        echo '</tr>';
//
//    }
//
//    echo '</tbody>';
//    echo '</table>';    

    // Подчеркивание под таблицей
//    echo "<hr />";
        
    ldap_close($ds);    
}