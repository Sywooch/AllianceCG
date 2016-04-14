<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>

<?= 'This is Calendar'; ?>

<?php 
        $formatter = new \yii\i18n\Formatter;
        $formatter->timeZone = 'Europe/Minsk';
        $formatter->dateFormat = 'php:Y-m-d';
        $formatter->timeFormat = 'php:h:i';
        $curdate = $formatter->asDate('now');        
        $curtime = $formatter->asTime('now');
        $tomorrow = $formatter->asDate('now + 1 day'); 
        
        
        echo $tomorrow;
?>