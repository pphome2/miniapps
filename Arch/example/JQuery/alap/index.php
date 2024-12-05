
<html>

<head>

<script type="text/javascript" src="../jq/jquery.min.js"></script>
<style>
	p {}
	.selected { color:blue; }
	.highlight { background:yellow; }
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

<br /> $(“p”) – Bekezdés elemek kijelölése.
<br /> $(“#box”) – A box id-vel rendelkező elem kijelölése.
<br /> $(“div#box”) – A box id-vel rendelkező div elem kijelölése.
<br /> $(“.box”) – A box class tulajdonsággal rendelkező elem kijelölése.



<p>Helló!</p>
<p>Szia!</p>
<p>Üdv!</p>


<p id=box>ID BOX szöveg</p>
<div id=box2>DIV-ID BOX2 szöveg</div>
<p class=box3>CLASS BOX3 szöveg</p>

<span value=text2>text</span> <- egér művelet
<div id=1>üres</div>

<p>last p</p>

<script>

(function($) {
	//$("p").css("background-color", "red");
	$("p").css("color", "red");
	$("#box").css("color", "yellow");
	$("div#box2").css("color", "blue");
	$(".box3").css("color", "grey");

	$("p:last").addClass("highlight"); // .removeClass - kiszedi, .toggleClass - ha van ki, ha nincs be

	var v=$("span").attr("value"); // elem attributuma
	var v=$("span").text(); // tartalma
    $("div#1").text(v);

	$('span').click(function() {
			alert('Handler for .click() called.'); //egér klikk
    });
    var p = $("p");
    console.log(p);
})(jQuery);

</script>



<ul class="topnav">
    <li>Item 1</li>
    <li>Item 2
        <ul class="topnav2"><li>Nested item 1</li><li>Nested item 2</li><li>Nested item 3</li></ul>
       </li>
    <li>Item 3</li>
</ul>

<script>
(function($) {
	$("ul.topnav2 > li").css("border", "3px double red");
})(jQuery);
</script>


</body>
</html>
