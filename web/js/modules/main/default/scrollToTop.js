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
window.onload = function() {
	var scrollBtn = document.getElementById('btn-scrolltop');
	window.onscroll = function () { // при скролле показывать и прятать блок
		if ( window.pageYOffset > 0 ) {
			scrollBtn.style.display = 'block';
		} else {
			scrollBtn.style.display = 'none';
		}
	};	
}