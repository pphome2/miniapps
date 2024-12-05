
// auto slideshow

var myIndex = 0;
carousel();

function carousel() {
    var i;
    var x = document.getElementsByClassName("mySlides");
    for (i = 0; i < x.length; i++) {
       x[i].style.display = "none";  
    }
    myIndex++;
    if (myIndex > x.length) {myIndex = 1}    
    x[myIndex-1].style.display = "block";  
    setTimeout(carousel, 2000);
}



// indicator slideshow

var slideIndex = 1;
showDivs(slideIndex);

function plusDivs(n) {
  showDivs(slideIndex += n);
}

function currentDiv(n) {
  showDivs(slideIndex = n);
}

function showDivs(n) {
  var i;
  var x = document.getElementsByClassName("mySlidesX");
  var dots = document.getElementsByClassName("badge");
  if (n > x.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = x.length}
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
     dots[i].className = dots[i].className.replace(" badge-white", " badge-nowhite");
  }
  x[slideIndex-1].style.display = "block"; 
  dots[slideIndex-1].className ="badge badge-white";
  //alert(dots[slideIndex-1].className+" "+slideIndex);
}




// modal

function mopenModal() {
  document.getElementById('myModal').style.display = "block";
}

function mcloseModal() {
  document.getElementById('myModal').style.display = "none";
}



var mslideIndex = 1;

mshowDivs(mslideIndex);

function mplusDivs(n) {
  mshowDivs(mslideIndex += n);
}

function mcurrentDiv(n) {
  mshowDivs(mslideIndex = n);
}

function mshowDivs(n) {
  var ii;
  var x = document.getElementsByClassName("slideimg");
  var dots = document.getElementsByClassName("mimg");
  var captionText = document.getElementById("caption");
  if (n > x.length) {mslideIndex = 1}
  if (n < 1) {mslideIndex = x.length}
  for (ii = 0; ii < x.length; ii++) {
     x[ii].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
     dots[i].className = dots[i].className.replace(" lighthalf", " lightfull");
  }
  x[mslideIndex-1].style.display = "block";
  //dots[mslideIndex-1].className += " lightfull";
  dots[mslideIndex-1].className = " mimg lighthalf";
  captionText.innerHTML = dots[mslideIndex-1].alt;
}




// filter table

function myfilter() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}




// tabbed

function opentab(evt, tabName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tab");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(tabName).style.display = "block";
    document.getElementById(tabName).className += " active";
    evt.currentTarget.className += " active";
}




// side menu


function smenu_open() {
  document.getElementById("page").style.marginLeft = "25%";
  document.getElementById("sidemenu").style.width = "25%";
  document.getElementById("sidemenu").style.display = "block";
  document.getElementById("opensidemenu").style.display = 'none';
}
function smenu_close() {
  document.getElementById("page").style.marginLeft = "0%";
  document.getElementById("sidemenu").style.display = "none";
  document.getElementById("opensidemenu").style.display = "inline-block";
}

