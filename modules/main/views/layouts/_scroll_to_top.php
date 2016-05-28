<?php 
   $this->registerCssFile('@web/css/scroll-top.css', ['depends' => ['app\assets\AppAsset']]);  
?>

<?= \bluezed\scrollTop\ScrollTop::widget() ?>