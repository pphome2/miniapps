<script>

function fullscreen(e){
	e.style.display="none";
	var elem=document.documentElement; 
	var elem=document.getElementsByTagName("BODY")[0];
	if (elem.requestFullscreen) {
		elem.requestFullscreen();
	} else if (elem.webkitRequestFullscreen) { /* Safari */
		elem.webkitRequestFullscreen();
	} else if (elem.msRequestFullscreen) { /* IE11 */
		elem.msRequestFullscreen();
	}
}

window.onload = function() {
	document.getElementById("fsbutton").click();
};

function col2(cid){
	var content=document.getElementById(cid);
	if (content.style.maxHeight){
		content.style.maxHeight=null;
	}else{
		content.style.maxHeight=content.scrollHeight+"px";
	}
}

function col(cid){
	var content=document.getElementById(cid);
	if (content.style.display==="block") {
		content.style.display="none";
	}else{
		content.style.display="block";
	}
}

</script>
