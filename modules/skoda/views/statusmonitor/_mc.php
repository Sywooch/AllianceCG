<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use app\modules\user\models\User;
?>
 
<div class="statusmonitor-item" style="text-align: center">
<table style="text-align: center">
  <tr>
    <th rowspan="2">
    	<h2>
            <?php 
                // echo Html::img('@web/' . $model->photo, ['width'=>'100']) 
                // return !empty($this->photo) ? \Yii::$app->homeUrl.$this->photo : \Yii::$app->homeUrl.'img/logo/avatar.jpeg';
                if (!empty($model->photo)){
                    echo Html::img('@web/' . $model->photo, ['width'=>'100']);
                }
                else{
                    echo Html::img('@web/img/logo/avatar.jpeg', ['width'=>'100']);
                }
                // echo User::getImageurl();
            ?>
        </h2>
    </th>
    <th style="padding-left: 25px; width: 80%;">
    	<!-- <h2> -->
            <?php
                echo '<h3>' . $model->name. ' ' . $model->surname . '</h3>';
                echo '<br/>';
                echo '<h4>' . HtmlPurifier::process($model->position ) . '</h4>';
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
    	HtmlPurifier::process($model->name) 
    ?>    
    <?php
    	HtmlPurifier::process($model->surname) 
    ?>    
</div>