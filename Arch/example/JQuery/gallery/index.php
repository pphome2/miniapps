
<script src="../jq/jquery.min.js"></script>
<?php
	include('./popup.php');
?>

<body>

	<div>
		<center>
		<br/>
		<br/>
		<br/>
		<br/>
		<br/>
		<h2>Modal text/image demo</h2>
		<br/>
		<a class="s-open-modal popup-btn" href="#" data-modal-id="popup1"> Pop Up One</a>
		<a class="s-open-modal popup-btn" href="#" data-modal-id="popup2" value=30> Pop Up Two</a>
	</div><div>
		<center>
		<br/>
		<br/>
		<br/>
		<br/>
		<br/>
		<h2>Modal text/image demo</h2>
		<br/>
		<a class="s-open-modal popup-btn" href="#"> No Pop Up One</a>
		<a class="s-open-modal popup-btn" href="#"> No Pop Up Two</a>
	</div>


<?php
	$message="
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut commodo at felis vitae facilisis.
		Cras volutpat fringilla nunc vitae hendrerit. Donec porta id augue quis sodales. Sed sit
		amet metus ornare, mattis sem at, dignissim arcu. Cras rhoncus ornare mollis. Ut tempor augue
		mi, sed luctus neque luctus non. Vestibulum mollis tristique blandit. Aenean condimentum in
		leo ac feugiat. Sed posuere, est at eleifend suscipit, erat ante pretium turpis, eget semper
		ex risus nec dolor. Etiam pellentesque nulla neque, ut ullamcorper purus facilisis at. Nam
		imperdiet arcu felis, eu placerat risus dapibus sit amet. Praesent at justo at lectus scelerisque
		mollis. Mauris molestie mattis tellus ut facilisis. Sed vel ligula ornare, posuere velit ornare,
		consectetur erat.</p>
		<center><img src=4.jpg width=70%><br />
		Teszt kép<br />
		Teszt kép<br />
		Teszt kép<br />
		Teszt kép<br />
		Teszt kép<br />
		Teszt kép<br />
		Teszt kép<br />
		Teszt kép<br />
		Teszt kép<br />
		Teszt kép<br />
		Teszt kép<br />
		Teszt kép<br />
		Teszt kép<br />
		</center>
	";
	$head="Első felugró ablak";
	$close="Bezár";
	popup_dir_load(".","popup1", $head, $message, $close);


	$message="
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut commodo at felis vitae facilisis.
		Cras volutpat fringilla nunc vitae hendrerit. Donec porta id augue quis sodales. Sed sit
		amet metus ornare, mattis sem at, dignissim arcu. Cras rhoncus ornare mollis. Ut tempor augue
		mi, sed luctus neque luctus non. Vestibulum mollis tristique blandit. Aenean condimentum in
		leo ac feugiat. Sed posuere, est at eleifend suscipit, erat ante pretium turpis, eget semper
		ex risus nec dolor. Etiam pellentesque nulla neque, ut ullamcorper purus facilisis at. Nam
		imperdiet arcu felis, eu placerat risus dapibus sit amet. Praesent at justo at lectus scelerisque
		mollis. Mauris molestie mattis tellus ut facilisis. Sed vel ligula ornare, posuere velit ornare,
		consectetur erat.</p>
		<center>Teszt kép<br />	</center>
	";
	$head="Első felugró ablak";
	$close="Bezár";
	popup_dir_load("","popup2", $head, $message, $close);
?>



<?php
	include('popup2.php');
?>

</body>
