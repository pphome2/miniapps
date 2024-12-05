
<html>

<head>

<script type="text/javascript" src="../jq/jquery.min.js"></script>
<style>
	p {}
	.selected { color:blue; }
	.highlight { background:yellow; }

	.menu {border: 2px solid green;padding:5px;cursor:pointer;}
	.page0 {border: 2px solid green;padding:5px;opacity:0;}
	.page1 {border: 2px solid green;padding:5px;opacity:0;}
</style>

</head>

<body>

<script>
</script>

<br /><br />
<br /><br />
<div id=menu>
	<span id=11 class=menu>Első lap</span>
	<span id=12 class=menu>Második lap</span>
	<span id=13 class=menu>Harmadik lap</span>
</div>

<br /><br />
Lap:
<br />
<div id=page0 class=page0></div>


<script>


	var $j = jQuery.noConflict();
	$j(document).ready(function($){
	    //alert('jQuery loaded.');
	    console.log('jQuery loaded.');

		var rtxt = "";
		$('span').click(function() {
			//alert(this.id); //egér klikk
			var str=this.id;
			if (str.length == 0) {
				$("#page0").text("");
				return;
			} else {
				$.post("post.php",
    				{
						name: this.id,
						city: "Nowhere"
				 	},
					function(data, status){
						if (status == "success"){
							rtxt = data;
							$( "#page0" ).animate({
								opacity: 0,
								height: "toggle"
							}, 1000, function() {
								// Animation complete.
								$("#page0").text(rtxt);
							});
		
							$( "#page0" ).animate({
								opacity: 1,
								height: "toggle"
							}, 1000, function() {
								// Animation complete.
							});
						}
					}
				);
				switch (str){
					case "11":
						var pr = "p1.php";
						$("#11").css({"color":"white","background":"red"});
						$("#12").css({"color":"black","background":"white"});
						$("#13").css({"color":"black","background":"white"});
						break;
					case "12":
						var pr = "p2.php";
						$("#11").css({"color":"black","background":"white"});
						$("#12").css({"color":"white","background":"red"});
						$("#13").css({"color":"black","background":"white"});
						break;
					case "13":
						var pr = "p3.php";
						$("#11").css({"color":"black","background":"white"});
						$("#12").css({"color":"black","background":"white"});
						$("#13").css({"color":"white","background":"red"});
						break;
				}
			}
		});
	});

</script>



<br /><br />
<br /><br />

</body>
</html>
