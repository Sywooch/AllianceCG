<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
?>
 
<div class="statusmonitor-item" style="text-align: center">
<table style="text-align: center">
  <tr>
    <th rowspan="2">
    	<h2>
            <?php 
                echo Html::img('@web/' . $model->photo, ['width'=>'100']) 
            ?>
        </h2>
    </th>
    <th style="padding-left: 25px; width: 80%;">
    	<!-- <h2> -->
            <?php
                echo '<h2>' . $model->name. ' ' . $model->surname . '</h2>';
                echo '<br/>';
                echo '<h3>' . $model->position . '</h3>';
                // echo $model->id;
            ?>
        <!-- </h2> -->
    </th>
  </tr>
  <tr>      
    <th style="padding-left: 25px; width: 80%;">
        <h3>
            <?php
                // echo $model->position;
                // echo $model->id;
            ?>
        </h3>
    </th>
  </tr>
</table>	
    <!-- <h2> -->
    	<?php
    		// Html::encode($model->id) 
    	?>
    <!-- </h2>     -->
    <?php
    	// HtmlPurifier::process($model->name) 
    ?>    
    <?php
    	// HtmlPurifier::process($model->surname) 
    ?>    
</div>