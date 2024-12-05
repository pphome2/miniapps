<?php

	# JQuery popup plugin for PHPortal
	#
	# <a> link elemben kell "data.modal-id" nevű tulajdonságnak lennie, ebből
	# tudja hogy ez a popup indítója
	#
	# "value" tilajdonságban lehet megadni a szélességet %-ban (% jel nélkül)
	#
	# example / példa:
	#	<a class="somathing" href="#" data-modal-id="popup1"> Pop Up One</a>
	#	<a class="s-open-modal popup-btn" href="#" data-modal-id="popup2" value=30>
	#

	function popup_load($class,$head,$mess,$close){
?>

		<div id=<?php echo($class);?> class="popup-modal-box">
			<header> <a href="#" class="popup-js-modal-close popup-x-close"> × </a>
				<h3><?php echo($head);?></h3>
			</header>
			<div id=<?php echo($class."1");?>  class="popup-modal-body">
				<?php echo($mess);?>
			</div>
			<footer> <a href="#" class="popup-btn popup-btn-small popup-js-modal-close"><?php echo($close);?></a> </footer>
		</div>

<?php
	}
?>

<style>
.popup-h2 {
  margin: 1.75em 0 0;
  font-size: 5vw;
}

.popup-h3 { font-size: 1.3em; }

.popup-v-center {
  height: 100vh;
  width: 100%;
  display: table;
  position: relative;
  text-align: center;
}

.popup-v-center > div {
  display: table-cell;
  vertical-align: middle;
  position: relative;
  top: -10%;
}

.popup-btn {
  font-size: 3vmin;
  padding: 0.75em 1.5em;
  background-color: #fff;
  border: 1px solid #bbb;
  color: #333;
  margin:1px;
  text-decoration: none;
  display: inline;
  bborder-radius: 4px;
  -webkit-transition: background-color 1s ease;
  -moz-transition: background-color 1s ease;
  transition: background-color 1s ease;
}

.popup-btn:hover {
  background-color: #ddd;
  -webkit-transition: background-color 1s ease;
  -moz-transition: background-color 1s ease;
  transition: background-color 1s ease;
}

.popup-btn-small {
  padding: .75em 1em;
  font-size: 0.8em;
  margin:1px;
}

.popup-modal-box {
  display: none;
  position: absolute;
  z-index: 1000;
  width: 98%;
  line-height: 1.5;
  background: white;
  border-bottom: 1px solid #aaa;
  border-radius: 4px;
  box-shadow: 0 3px 9px rgba(0, 0, 0, 0.5);
  border: 1px solid rgba(0, 0, 0, 0.1);
  background-clip: padding-box;
}
@media (min-width: 32em) {

.popup-modal-box { width: 70%; }
}

.popup-modal-box header,
.popup-modal-box .popup-modal-header {
  padding: 1.25em 1.5em;
  border-bottom: 1px solid #ddd;
}

.popup-modal-box header h3,
.popup-modal-box header h4,
.popup-modal-box .popup-modal-header h3,
.popup-modal-box .popup-modal-header h4 { margin: 0; }

.popup-modal-box .popup-modal-body { padding: 2em 1.5em;}
.popup-modal-body {overflow: auto;font-size: 2vmin;height:auto;}

.popup-modal-box footer,
.popup-modal-box .popup-modal-footer {
  padding: 1.5em;
  border-top: 1px solid #ddd;
  background: rgba(0, 0, 0, 0.02);
  text-align: right;
}

.popup-modal-overlay {
  opacity: 0;
  filter: alpha(opacity=0);
  position: absolute;
  top: 0;
  left: 0;
  z-index: 900;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 1) !important;
}

.popup-x-close {
  line-height: 1;
  font-size: 1.5em;
  position: absolute;
  top: 2%;
  right: 2%;
  text-decoration: none;
  color: #bbb;
}

.popup-x-close:hover {
  color: #222;
  -webkit-transition: color 1s ease;
  -moz-transition: color 1s ease;
  transition: color 1s ease;
}
.popup-modal-body {
    display: inline-block;
}
</style>

<script>
    $(function(){
        var appendthis =  ("<div class='popup-modal-overlay popup-js-modal-close'></div>");
		var origWidth = $(".popup-modal-box").css('width');
		$('a[data-modal-id]').click(function(e) {
			var modalBox = $(this).attr('data-modal-id');
			var modalWidth = $(this).attr('value');
			$(window).resize(function(){
				if (modalWidth > 0){
					$('#'+modalBox+".popup-modal-box").css({
						width: ($(window).width() / 100) * modalWidth
					});
				} else {
					$('#'+modalBox+".popup-modal-box").css({
						width: origWidth
					});
				}
				if ($(window).height() < $('#'+modalBox+".popup-modal-box").innerHeight()){
					$('#'+modalBox+".popup-modal-box").css({
						height: ($(window).height() * 0.9)
					});
					$('#'+modalBox+"1.popup-modal-body").css({
						height: ($(window).height() * 0.9) - 185
					});
				}
				$('#'+modalBox+".popup-modal-box").css({
					top: ($(window).height() - $('#'+modalBox+".popup-modal-box").outerHeight()) / 2,
					left: ($(window).width() - $('#'+modalBox+".popup-modal-box").outerWidth()) / 2
				});
			});
			$(window).resize();
			e.preventDefault();
			$("body").append(appendthis);
			$(".popup-modal-overlay").fadeTo(500, 0.7);
			$(".popup-js-modalbox").fadeIn(500);
			$('#'+modalBox).fadeIn($(this).data());
		});
		$(".popup-js-modal-close, .popup-modal-overlay").click(function() {
			$(".popup-modal-box, .popup-modal-overlay").fadeOut(500, function() {
				$(".popup-modal-overlay").remove();
			});

		});
	});
</script>

