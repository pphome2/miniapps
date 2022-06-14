<script>

function cardclose(th,th2){
	if (th.style.display=='none'){
		th.style.display='block';
		th2.style.top='0px';
		th2.innerHTML=' &#65087; ';
	} else {
		th.style.display='none';
		th2.style.top='10px';
		th2.innerHTML=' &#65088; ';
	}
}

</script>
