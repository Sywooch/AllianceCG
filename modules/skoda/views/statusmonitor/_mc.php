<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use app\modules\user\models\User;
?>
 
<div class="statusmonitor-item" style="text-align: center">
<table style="text-align: center">
    <tr>
        <td>
        <h2>
            <?php 
                if (!empty($model->photo)){
                    echo Html::img('@web/' . $model->photo, ['width'=>'200', 'class' => 'img-rounded']);
                }
                else{
                    echo Html::img('@web/img/logo/avatar.jpeg', ['width'=>'100']);
                }
            ?>
        </h2>            
        </td>
        <tr>
            <td>
                <?php
                    echo '<h3>' . $model->name. ' ' . $model->surname . '</h3>';
                ?>                
            </td>
        </tr>
        <tr>
            <td>
                <?php
                    echo '<h4>' . HtmlPurifier::process($model->position ) . '</h4>'    
                ?>
            </td>
        </tr>
    </tr>
</table>
</div>