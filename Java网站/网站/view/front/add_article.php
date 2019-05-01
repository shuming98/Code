<?php 
session_start();
require('../../lib/init.php');

//防止非法入侵
if($_SESSION['permission_id']!=0 && $_SESSION['permission_id']!=1){
	echo "<script>alert('此非你该来的地方');</script>";
	echo "<script>location.replace('../../home.php');</script>";
	exit;
}

//查询目录名
$sql = "select dirname from study_dir where user_account = '$_SESSION[user_account]'";
$dirname = mGetAll($sql);
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../../css/public.css">
	<script src="../../js/jquery.js"></script>
	<title>发布文章</title>
</head>
<body>
	<?php include('./nav.php'); ?>
	<!-- 发布文章容器 -->
	<div class="study_add_article">
		<p><a href="./study.php">学习园地</a>&gt;<span>发布文章</span></p>
		<form id="article_form"  method="post" accept-charset="utf-8">
			<input type="text" name="art_title" placeholder="请输入文章标题">
			<!--加载编辑器的容器-->
			<script id="container" name="content" type="text/plain"></script>
				<select name="dirname">
					<option value="default">选择目录</option>
			<?php foreach($dirname as $v){ 
				echo '<option value="',$v['dirname'],'">',$v['dirname'],'</option>';
				}?>
				</select>
			<input type="submit" value="发布">
		</form>
		</div>
	<?php include('../front/foot.html'); ?>
</body>
<!-- 配置文件 -->
<script type="text/javascript" src="../../ueditor/utf8-php/ueditor.config.js"></script>
<!-- 编辑器源码文件 -->
<script type="text/javascript" src="../../ueditor/utf8-php/ueditor.all.min.js"></script>
<!-- 实例化编辑器 -->
<script type="text/javascript">
    var ue = UE.getEditor('container', {
    toolbars: [
    ['undo','redo','removeformat','|','bold','italic','underline','strikethrough','horizontal','|','fontsize','forecolor','backcolor','|','indent','justifyleft','justifycenter','justifyright','|','insertorderedlist','insertunorderedlist','|','insertcode','simpleupload','fullscreen','attachment','drafts','|','preview','help']
	],
	autoHeightEnabled: false,
    autoFloatEnabled: false
});
    ue.ready(function(){
    	ue.setHeight(500);
    });


//ajax
$("#article_form").submit(function(){
var data={
    'art_title':$("#article_form input[name='art_title']").val(),
    'content':ue.getContent(),
    'dirname':$("#article_form select[name='dirname']").val()
};
$.post('../admin/add_article.php',data,function(res){
    alert(res);
    history.back();
  });
return false;
});
</script>
</html>