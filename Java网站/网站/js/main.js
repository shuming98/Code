//轮播图
var slideIndex = 0;
showSlides();

function showSlides() {
  var i;
  var slides = document.getElementsByClassName("slides");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}    
  slides[slideIndex-1].style.display = "block";  
  setTimeout(showSlides, 3000); 
}

//登录模态框
@characterSet:
var login = document.getElementById('login');
window.onclick = function(event){
	if(event.target == login){
		login.style.display = "none";
	}
}

//上传资源模态框
var upload_resource = document.getElementById('upload_resource');
window.onclick = function(event){
  if(event.target == upload_resource){
    upload_resource.style.display = "none";
  }
}

//批改作业模态框
var check_work = document.getElementById('check_work');
window.onclick = function(event){
  if(event.target == check_work){
    check_work.style.display = "none";
  }
}

//查看作业模态框
var show_work = document.getElementById('show_work');
window.onclick = function(event){
  if(event.target == show_work){
    show_work.style.display = "none";
  }
}

//知识树
var toggler = document.getElementsByClassName("caret");
var i;
for(i=0;i<toggler.length;i++){
  toggler[i].addEventListener("click",function(){
    this.parentElement.querySelector(".nested").classList.toggle("active");
    this.classList.toggle("caret_down");
  });
}
