<?php 
	use yii\helpers\Html;
	use yii\web\View;

   	$this->registerCssFile('/css/scroll-top.css', ['depends' => ['app\assets\AppAsset']]);  
	$scrollToTop = file_get_contents('js/modules/main/default/scrollToTop.js');
	$this->registerJs($scrollToTop, View::POS_END);
?>

<?= Html::a(Html::tag('i', '', ['class'=>'glyphicon glyphicon-menu-up scrolltop-circle']), '#', ['onclick' => "return up()", 'id'=>'btn-scrolltop', 'class'=>'scrolltop']); ?>