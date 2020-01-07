<?php 
session_start();
require('../../lib/acc_admin.php');
require('../../lib/init.php');

//查询资源分类
$sql = "select id,cat_name from news_cat";
$catname = mGetAll($sql);
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
	<title>引入站外文章</title>
</head>
<body>
	<?php include('./header.php'); ?>
	<div class="manage_container">
		<?php include('./sidenav.html'); ?>
		<div class="function">
			<div class="add_link_container">
				<h2 class="h2_title">引入站外文章</h2>
				<span class="h2_line"></span>
				<form id="link_form" method="post">
					<input type="text" name="title" placeholder="请输入资讯标题" maxlength="50" required="required">
					<textarea name="link" placeholder="在此粘贴站外链接&#10;如:https://www.baidu.com" required="required"></textarea>
					<a id="test_link" target="_blank">测试链接</a>
					<select name="news_id">
						<option value="default">选择分类</option>
					<?php foreach($catname as $v){ 
						echo '<option value="',$v['id'],'">',$v['cat_name'],'</option>';
						}?>
					</select>
					<input type="submit" value="添加">
					<div class="clearfix"></div>
				</form>
			</div>
		</div>
	</div>
	<?php include('./footer.html'); ?>
</body>
<script>
//屏蔽报错
function catchErrors() {
	return true;
}

window.onerror = catchErrors;

//ajax检测链接是否有效
$("textarea[name='link']").blur(function(){
$.ajax({
  url: $("textarea[name='link']").val(),
  type: 'GET',
  dataType:'jsonp',
  complete: function(response) {
   if(response.status == 200) {
    $("#test_link").text('链接有效');
    $("#test_link").attr('href',$("textarea[name='link']").val());
    $("#link_form input[type=submit]").removeAttr('disabled');
   }else{
    $("#test_link").text('链接无效,请输入完整链接');
    $("#test_link").attr('href','javascript:void(0);');
    $("#link_form input[type=submit]").attr('disabled','true');
   }
  }
});
});

//ajax添加外链
$("#link_form").submit(function(){
	$.post('../admin/add_link.php',$("#link_form").serialize(),function(res){
		if(res == 0){
			alert('请选择分类');
		}else{
			alert(res);
			location.reload();
		}
	});
	return false;
});
</script>
</html>