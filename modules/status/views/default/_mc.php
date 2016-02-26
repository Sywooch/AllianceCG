<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
?>
 
<div class="statusmonitor-item" style="text-align: center">
<table style="text-align: center">
  <tr>
    <th>
    	<h2><?= Html::img('@web/' . $model->photo, ['width'=>'100']) ?></h2>
    </th>
    <th style="padding-left: 25px; width: 80%;">
    	<h2><?php echo $model->name . ' ' . $model->surname ?></h2>
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