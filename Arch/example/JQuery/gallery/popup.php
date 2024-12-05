<?php

	# JQuery popup plugin for PHPortal
	#
	# <a> link elemben kell "data.modal-id" nevű tulajdonságnak lennie, ebből
	# tudja hogy ez a popup indítója
	#
	# "value" tulajdonságban lehet megadni a szélességet %-ban (% jel nélkül)
	#
	# example / példa:
	#	<a class="somathing" href="#" data-modal-id="popup1"> Pop Up One</a>
	#	<a class="s-open-modal popup-btn" href="#" data-modal-id="popup2" value=30>
	#


	function popup_dir_load($dir,$class,$head,$mess,$close){
		$ifiles="var iFiles = [";
		$db=0;
		$arr=array("jpg","png","gif");
		if ($dir==""){
			$dir=".";
		}
		$cdir = scandir($dir);
		foreach ($cdir as $key => $value){
			if (!in_array($value,array(".",".."))){
				if (!is_dir($dir . "/" . $value)){
					$ext=substr($value,strlen($value)-3,3);
					if (in_array($ext,$arr)){
						$ifiles=$ifiles."\"".$dir . "/" . $value."\",";
						$db++;
					}
				}
			}
		}
		if (substr($ifiles,strlen($ifiles)-1,1)==","){
			$ifiles=substr($ifiles,0,strlen($ifiles)-1);
		}
		$ifiles=$ifiles."];";
		echo("<script>".$ifiles." var iDb = ".$db.";</script>");

?>

		<div id=<?php echo($class);?> class="popup-modal-box">
			<header> <a href="#" class="popup-js-modal-close popup-x-close"> × </a>
				<h3><?php echo($head);?></h3>
			</header>
			<div id=<?php echo($class."img");?>  class="popup-modal-body">
				<?php #echo($mess);
					if ($db>0){
				?>
				<a href="#" id="popup-gallery-prev" class="popup-js-prev popup-prev" data-modal-id=<?php echo($class);?>> < </a>
				<?php
					}
				?>
				<center>
				<img id=<?php echo($class."-img");?> class="popup-img" src="">
				</center>
				<?php
					if ($db>0){
				?>
				<a href="#" id="popup-gallery-next" class="popup-js-next popup-next" data-modal-id=<?php echo($class);?>> > </a>
				<?php
					}
				?>
			</div>
			<footer>
				<p id=<?php echo($class."n");?> class="popup-imgnum">1 / <?php echo($db); ?></p>
				<a href="#" class="popup-btn popup-btn-small popup-js-modal-close"><?php echo($close);?></a>
			</footer>
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

.popup-imgnum {
  padding: .75em 1em;
  font-size: 0.8em;
  padding: 0.75em 1.5em;
  background-color: #fff;
  bborder: 1px solid #bbb;
  color: #333;
  left: 2%;
  text-decoration: none;
  display: inline;
  border-radius: 4px;
  -webkit-transition: background-color 1s ease;
  -moz-transition: background-color 1s ease;
  transition: background-color 1s ease;
}

.popup-img {
  padding: .75em 1em;
  height: 75%;
  wwidth: 95%;
  width: auto;
  font-size: 0.8em;
}

.popup-imgtxt {
  padding: .75em 1em;
  font-size: 0.8em;
  font-size: 3vmin;
  padding: 0.75em 1.5em;
  background-color: #fff;
  bborder: 1px solid #bbb;
  color: #333;
  left: 2%;
  width: 80%;
  text-decoration: none;
  display: inline;
  border-radius: 4px;
  -webkit-transition: background-color 1s ease;
  -moz-transition: background-color 1s ease;
  transition: background-color 1s ease;
}

.popup-btn {
  font-size: 3vmin;
  padding: 0.75em 1.5em;
  background-color: #fff;
  border: 1px solid #bbb;
  color: #333;
  text-decoration: none;
  display: inline;
  right: 2%;
  border-radius: 4px;
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
.popup-modal-body {overflow: auto;hheight:auto;align:center}

.popup-modal-box footer,
.popup-modal-box .popup-modal-footer {
  padding: 1em;
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

.popup-next {
  line-height: 1;
  font-size: 1.5em;
  position: absolute;
  top: 50%;
  mmargin-top: 30%;
  mmargin-bottom: 30%;
  right: 2%;
  text-decoration: none;
  color: #bbb;
}

.popup-next:hover {
  color: #222;
  -webkit-transition: color 1s ease;
  -moz-transition: color 1s ease;
  transition: color 1s ease;
}

.popup-prev {
  line-height: 1;
  font-size: 1.5em;
  position: absolute;
  top: 50%;
  left: 2%;
  text-decoration: none;
  color: #bbb;
}

.popup-prev:hover {
  color: #222;
  -webkit-transition: color 1s ease;
  -moz-transition: color 1s ease;
  transition: color 1s ease;
}
.popup-modal-body {
    ddisplay: inline-block;
}
</style>

<script>
    $(function(){
		jQuery.each(iFiles,function(i,val){
			//alert(val);
		});
		var aktImage = 0;
		var firstRun = true;
        var appendthis = ("<div class='popup-modal-overlay popup-js-modal-close'></div>");
		var origWidth = $(".popup-modal-box").css('width');
		var origIWidth = $(".popup-img").css('width');
		$('a[data-modal-id]').click(function(e) {
			if (firstRun){
				$(".popup-modal").resize();
				$("body").append(appendthis);
				$(".popup-modal-overlay").fadeTo(500, 0.7);
				$(".popup-js-modalbox").fadeIn(500);
				firstRun = false;
				var modalBox = $(this).attr('data-modal-id');
				var modalWidth = $(this).attr('value');
				$('#'+modalBox+"-img.popup-img").attr("src",iFiles[aktImage]);
				if (modalWidth > 0){
					$('#'+modalBox+".popup-modal-box").css({
						width: ($(window).width() / 100) * modalWidth + 60
					});
				} else {
					$('#'+modalBox+".popup-modal-box").css({
						width: origWidth + 60
					});
				}
				if ($(window).height() < $('#'+modalBox+".popup-modal-box").innerHeight()){
					$('#'+modalBox+".popup-modal-box").css({
						height: ($(window).height() * 0.9)
					});
					$('#'+modalBox+"1.popup-modal-body").css({
						height: ($(window).height() * 0.9) - 165
					});
					$('#'+modalBox+"-img.popup-img").css({
						height: ($(window).height() * 0.9) - 165
					});
				}
				if ($('#'+modalBox+".popup-modal-body").width() < $('#'+modalBox+".popup-img").innerWidth()){
					alert("w");
					$('#'+modalBox+".popup-img").css({
						width: ($(window).height() * 0.9)
					});
				}
				$('#'+modalBox+".popup-modal-box").css({
					top: ($(window).height() - $('#'+modalBox+".popup-modal-box").outerHeight()) / 2,
					left: ($(window).width() - $('#'+modalBox+".popup-modal-box").outerWidth()) / 2
				});
				e.preventDefault();
				$('#'+modalBox).fadeIn($(this).data());
			}
		});
		$(".popup-js-next").click(function() {
			var modalBox = $(this).attr('data-modal-id');
			aktImage++;
			if (aktImage>=iDb){
				aktImage=0;
			}
			//$(".popup-gallery-next").attr("src",iFiles[aktImage]);
			$('#'+modalBox+"-img.popup-img").attr("src",iFiles[aktImage]);
			$('#'+modalBox+"n.popup-imgnum").text((aktImage+1)+" / "+iDb);
			$(".popup-modal").resize();
		});
		$(".popup-js-prev").click(function() {
			var modalBox = $(this).attr('data-modal-id');
			aktImage--;
			if (aktImage<0){
				aktImage=iDb-1;
			}
			$('#'+modalBox+"-img.popup-img").attr("src",iFiles[aktImage]);
			$('#'+modalBox+"n.popup-imgnum").text((aktImage+1)+" / "+iDb);
			$(".popup-modal").resize();
		});
		$(".popup-js-modal-close, .popup-modal-overlay").click(function() {
			$(".popup-modal-box, .popup-modal-overlay").fadeOut(500, function() {
				$(".popup-modal-overlay").remove();
			});
			firstRun = true;
		});
	});
</script>

