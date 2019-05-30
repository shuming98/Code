<?php 
session_start();
require('../../lib/acc_admin.php');
require('../../lib/init.php');
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="renderer" content="webkit">
  <link rel="icon" href="../../images/icon/labelLogo.jpg">
	<link rel="stylesheet" type="text/css" href="../../css/manage.css">
	<script src="../../js/jquery.js"></script>
	<title>添加轮播图</title>
</head>
<body>
	<?php include('./header.php'); ?>
	<div class="manage_container">
		<?php include('./sidenav.html'); ?>
		<div class="function">
			<div class="slideshow_container">
				<h2 class="h2_title">添加轮播图</h2>
				<span class="h2_line"></span>
				<form id="add_slideshow" method="post" enctype="multipart/form-data">
					<div id="showImg"><img src="" alt=""></div>
					<p>上传图片：<input id="up_img" type="file" name="slideshow" accept="image/*" onchange="fileUpLoad(this);" required="required">(轮播图分辨率：760*425)</p>
					<p>图片描述：</p>
					<textarea name="content"></textarea>
					<input type="submit" value="添加">
					<div class="clearfix"></div>
				</form>
				
			</div>
		</div>
	</div>
	<?php include('./footer.html'); ?>
</body>
<script>
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

//ajax添加轮播图
$("#add_slideshow").submit(function(){
var form_data = new FormData($("#add_slideshow")[0]);
  $.ajax({
        url: "../admin/add_slideshow.php",
        type: "post",
        data: form_data,
        processData: false,
        contentType: false,
        success:function(data){
            alert(data);
            location.reload();
        },
        error:function(data){
            alert('发布失败');
        }
    });
  return false;
});
</script>
</html>