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
	<title>优秀师生添加</title>
</head>
<body>
	<?php include('./header.php'); ?>
	<div class="manage_container">
		<?php include('./sidenav.html'); ?>
		<div class="function">
			<div class="add_excellent_container">
				<h2 class="h2_title">优秀师生添加</h2>	
				<span class="h2_line"></span>
				<form id="add_excellent" class="excellent_form" method="post" enctype="multipart/form-data" action="../admin/add_excellent.php">
					<div id="showFigure" class="show_img"><img src="" alt=""></div>
					<p>上传照片：<input id="up_img" type="file" name="figure" accept="image/*" onchange="fileUpLoad(this);"></p>
					<p>姓名：<input type="text" name="name" maxlength="4" required="required"></p>
					<p>添加至：<select name="identify">
						<option value="1">优秀教师</option>
						<option value="3">优秀学生</option>
					</select></p>
					<input type="submit" value="添加">
				</form>
			</div>	
		</div>
	</div>
	<?php include('./footer.html'); ?>
</body>
<script>
//上传图片并预览
var imgCont = document.getElementById("showFigure"); 
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

//ajax添加优秀师生
$("#add_excellent").submit(function(){
var form_data = new FormData($("#add_excellent")[0]);
  $.ajax({
        url: "../admin/add_excellent.php",
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