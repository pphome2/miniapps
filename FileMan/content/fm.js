<script>

function delrow(obj){
	obj2=obj.parentNode;
	obj2.parentNode.style.display='none';
}

function cardclose2(th,th2){
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
