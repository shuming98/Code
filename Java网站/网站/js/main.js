

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


//轮播图
// var slideIndex = 0;

// function showSlides() {
//   var i;
//   var slides = document.getElementsByClassName("slides");
//   for (i = 0; i < slides.length; i++) {
//     slides[i].style.display = "none";  
//   }
//   slideIndex++;
//   if (slideIndex > slides.length) {slideIndex = 1}    
//   slides[slideIndex-1].style.display = "block";  
//   setTimeout(showSlides, 3000); 
// }
// showSlides();


//知识树
var toggler = document.getElementsByClassName("caret");
var i;
for(i=0;i<toggler.length;i++){
  toggler[i].addEventListener("click",function(){
    this.parentElement.querySelector(".nested").classList.toggle("active");
    this.classList.toggle("caret_down");
  });
}




//显示当前时间
var timer=null;
function displayClock(num){
  if(num<10){
    return "0"+num;
  }
  else{
    return num;
  }
}
//停止计时
function stopClock(){
  clearTimeout(timer);
}
//开始计时
function startClock(){
  var time =new Date();
  var hours=displayClock(time.getHours())+":";
  var minutes=displayClock(time.getMinutes())+":";
  var seconds=displayClock(time.getSeconds());
  //显示时间
  show_time.innerHTML=hours+minutes+seconds;
  timer=setTimeout("startClock()",1000);
}


/**
 * Jquery
 */

//绑定xhr.upload.onprogress监听事件
var xhrOnProgress=function(fun) {
  xhrOnProgress.onprogress = fun; 
  return function() {
    var xhr = $.ajaxSettings.xhr();
    if (typeof xhrOnProgress.onprogress !== 'function')
      return xhr;
    if (xhrOnProgress.onprogress && xhr.upload) {
      xhr.upload.onprogress = xhrOnProgress.onprogress;
    }
    return xhr;
  }
}

//ajax上传资源表单
   $("#upload_resource_form").submit(function(){
  var form_data = new FormData($("#upload_resource_form")[0]);
      $.ajax({
            url: "../admin/upload_resource.php",
            type: "post",
            data: form_data,
            processData: false,
            contentType: false,
            xhr:xhrOnProgress(function(e){
                var percent=100*e.loaded / e.total;
                $("#upload_progress").css('width',percent+'%');
                  $("#upload_rate").text(Math.ceil(percent)+'%');
              }),
            success:function(data){
                alert(data);
            },
            error:function(data){
                alert(data);
            }
        });
      return false;
    });

//ajax添加资源分类标签
  $("#add_tag form").submit(function(){
  var data={'tag_name':$("#add_tag input[name='tag_name']").val()};
  $.post('../admin/add_tag.php',data,function(res){
    alert(res);
  });
  return false;
});

//ajax发布作业
   $("#issue_work").submit(function(){
  var form_data = new FormData($("#issue_work")[0]);
      $.ajax({
            url: "../admin/issue_work.php",
            type: "post",
            data: form_data,
            processData: false,
            contentType: false,
            success:function(data){
                alert(data);
            },
            error:function(data){
                alert('发布失败');
            }
        });
      return false;
    });
