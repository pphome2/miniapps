
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
var $j = jQuery.noConflict();
$j(document).ready(function(){
    //alert('jQuery loaded.');
    console.log('jQuery loaded.');
});

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

var rtxt = "";

(function($) {
	$('span').click(function() {
		//alert(this.id); //egér klikk
		var str=this.id;
		if (str.length == 0) {
					$("#page0").text("");
			return;
		} else {
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200){
					rtxt = this.responseText;
					$( "#page0" ).animate({
						opacity: 0,
						//left: "+=50",
						height: "toggle"
					}, 1000, function() {
						// Animation complete.
						$("#page0").text(rtxt);
					});

					$( "#page0" ).animate({
						opacity: 1,
						//left: "+=50",
						height: "toggle"
					}, 1000, function() {
						// Animation complete.
					});

					//$("#page0").text(this.responseText);
				}
			};
			switch (str){
				case "11":
					var pr = "p1.php";
					$("#11").css("color","white");
					$("#11").css("background","red");
					$("#12").css("color","black");
					$("#12").css("background","white");
					$("#13").css("color","black");
					$("#13").css("background","white");
					break;
				case "12":
					var pr = "p2.php";
					$("#11").css("color","black");
					$("#11").css("background","white");
					$("#12").css("color","white");
					$("#12").css("background","red");
					$("#13").css("color","black");
					$("#13").css("background","white");
					break;
				case "13":
					var pr = "p3.php";
					$("#11").css("color","black");
					$("#11").css("background","white");
					$("#12").css("color","black");
					$("#12").css("background","white");
					$("#13").css("color","white");
					$("#13").css("background","red");
					break;
			}
			xmlhttp.open("GET", pr, true);
			xmlhttp.send();
		}
    });

	$("#11").click();

})(jQuery);


</script>



<br /><br />
<br /><br />
<div id=menu>
	<span id=1 onclick="showPage(this.id)">Első lap</span>
	<span id=2 onclick="showPage(this.id)">Második lap</span>
	<span id=3 onclick="showPage(this.id)">Harmadik lap</span>
</div>

<br /><br />
Lap:
<br />
<div id=page>
</div>

<script>


function showPage(str){
    if (str.length == 0) {
        document.getElementById("page").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("page").innerHTML = this.responseText;
            }
        };
        switch (str){
			case "1":
				var pr = "p1.php";
				document.getElementById("1").style.color = "blue";
				document.getElementById("2").style.color = "black";
				document.getElementById("3").style.color = "black";
				break;
			case "2":
				var pr = "p2.php";
				document.getElementById("1").style.color = "black";
				document.getElementById("2").style.color = "blue";
				document.getElementById("3").style.color = "black";
				break;
			case "3":
				var pr = "p3.php";
				document.getElementById("1").style.color = "black";
				document.getElementById("2").style.color = "black";
				document.getElementById("3").style.color = "blue";
				break;
		}
        xmlhttp.open("GET", pr, true);
        xmlhttp.send();
    }
}


document.getElementById("1").click();

</script>


</body>
</html>
