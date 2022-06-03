<script>

function delrow(obj){
	obj2=obj.parentNode;
	obj2.parentNode.style.display='none';
}

function cardclose(th,th2){
	if (th.style.display=='none'){
		th.style.display='block';
		th2.innerHTML=' -- ';
	} else {
		th.style.display='none';
		th2.innerHTML=' + ';
	}
}

</script>
