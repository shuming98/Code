//上传图片并预览
var imgCont = document.getElementById("showImg"); 
var ipt = document.getElementById("up_img"); 
function fileUpLoad(_this){
  var file = _this.files[0];
  if(!FileReader){
    alert("你的浏览器不支持H5的FileReader");
    ipt.setAttribute("disabled","disabled");
    return;
  }
  var fileReader = new FileReader();
  fileReader.readAsDataURL(file);
  fileReader.onload = function(e){
    var img = '<img src="'+this.result+'"/>';
    imgCont.innerHTML = img;
    console.log(this.result);
  }
}

window.onload = function(){
  var imgs = document.getElementsByTagName("img");
  for(var i=0;i<imgs.length;i++){
    imgs[i].oncontextmenu=function(){ return false;}
    imgs[i].ondragstart=function(){ return false;}
  }
}