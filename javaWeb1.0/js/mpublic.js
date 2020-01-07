//侧边导航栏
var dropdown = document.getElementsByClassName("dropdown_btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
  this.classList.toggle("active");
  var dropdownContent = this.nextElementSibling;
  if (dropdownContent.style.display === "block") {
  dropdownContent.style.display = "none";
  } else {
  dropdownContent.style.display = "block";
  }
  });
}

window.onload = function(){
	var imgs = document.getElementsByTagName("img");
	for(var i=0;i<imgs.length;i++){
		imgs[i].oncontextmenu=function(){ return false;}
		imgs[i].ondragstart=function(){ return false;}
	}
}