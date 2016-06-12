<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>

<?php
	// if(isset($_GET['status']))
	// {
	// 	// echo $_GET['status'];
	// 	print_r($_GET['status']);
	// }
	// else
	// {
	// 	echo 'not isset!';
	// }

	// var_dump($_GET['status']);
	// echo '<br/>';
	// $status = $_GET['status'];
	// $status = implode(', ', $status);
	// echo $status;
	
        // global $where;

        // if(isset($_GET['status']))
        {
          //   $status = array();
          //   $status = $_GET['status'];
          //   $status = implode(', ', $status);
          //   $where = "AND {{%calendar}}.status IN (".$status.")";
         	// echo $where;   
            // foreach ($_GET['status[]'] as $key => $value) {
            //     $where .= "AND status IN '$value'";
            // }
        }

?>



<?php echo $model->calendarSearch(); ?>