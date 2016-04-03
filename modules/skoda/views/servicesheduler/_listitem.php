<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    use yii\helpers\Html;
    use yii\helpers\HtmlPurifier;
    use app\modules\user\models\User;
    use rmrevin\yii\fontawesome\FA;
?>

<?php 
    $model->date = Yii::$app->formatter->asDate($model->date , 'dd/MM/yyyy');
?>

<table>
  <tr>
      <th rowspan="2">
          <div class="col-lg-5">
            <?= Html::img('@web/img/logo/avatar.jpeg', [
                    'class'=>'img-thumbnail',
                    'width'=>'180px'
                ])
            ?>
          </div>
      </th>
      <th>
          <div class="col-lg-12">
              <?= '<h4>' . FA::icon('user') . ' ' . HtmlPurifier::process($model->responsible) .'</h4>' ?>
          </div>          
      </th>
  </tr>
  <tr>
      <td>
          <div class="col-lg-12">
              <?= '<h5>' . FA::icon('calendar') . ' ' . HtmlPurifier::process($model->date) .'</h5>' ?>
          </div>          
      </td>
  </tr>
</table>


<div class="row" style="text-align: center">
    <div class="col-md-4">
        
    </div>
    <div class="col-md-8">
      <div>
          
      </div>
      <div>
          
      </div>
    </div>
    <br/>
  </div>
