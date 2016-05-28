<?php 

	use yii\helpers\Html;

   	$this->registerCssFile('@web/css/scroll-top.css', ['depends' => ['app\assets\AppAsset']]);  
?>

<?= \bluezed\scrollTop\ScrollTop::widget() ?>

<script type="text/javascript">

	var t;
	function up() {
		var top = Math.max(document.body.scrollTop,document.documentElement.scrollTop);
		if(top > 0) {
			window.scrollBy(0,-100);
			t = setTimeout('up()',10);
		}
		else clearTimeout(t);
	return false;
	}

</script>

<!-- <a href="#" onclick="return up()">наверх</a> -->
