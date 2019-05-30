<?php 
session_start();
require('../../lib/acc_teacher.php');
require('../../lib/init.php');


//查询目录名
$sql = "select dirname_id,dirname from study_dir where user_account = '$_SESSION[user_account]'";
$dirname = mGetAll($sql);
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="renderer" content="webkit">
	<link rel="icon" href="../../images/icon/labelLogo.jpg">
	<link rel="stylesheet" type="text/css" href="../../css/public.css">
	<script src="../../js/jquery.js"></script>
	<title>发布文章</title>
</head>
<body style="background: #f8f8f8">
	<?php include('./nav.php'); ?>
	<!-- 发布文章容器 -->
	<div class="study_add_article">
	<div class="ue_line">	
		<span class="ue_nav"><span><a href="./study.php">学习园地</a></span></span><span class="ue_tri"></span><span class="ue_nav2"><span>发布文章</span></span><span class="ue_tri"></span>
	</div>
		<form id="article_form" action="../admin/add_article.php" method="post">
			<input type="text" name="art_title" placeholder="请输入文章标题" required="required" maxlength="20">
			<!--加载编辑器的容器-->
			<script id="container" name="content" type="text/plain"></script>
				<select name="dirname">
					<option value="0">选择目录</option>
			<?php foreach($dirname as $v){ 
				echo '<option value="',$v['dirname_id'],'">',$v['dirname'],'</option>';
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
    ['undo','redo','removeformat','|','bold','italic','underline','strikethrough','horizontal','|','fontsize','forecolor','backcolor','|','indent','justifyleft','justifycenter','justifyright','|','insertorderedlist','insertunorderedlist','|','insertcode','simpleupload','fullscreen','attachment','drafts','|','preview']
	],
	autoHeightEnabled: false,
    autoFloatEnabled: false
});
    ue.ready(function(){
    	ue.setHeight(500);
    });


//ajax发布文章
$("#article_form").submit(function(){
var data={
    'art_title':$("#article_form input[name='art_title']").val(),
    'content':ue.getContent(),
    'dirname':$("#article_form select[name='dirname']").val()
};
$.post('../admin/add_article.php',data,function(res){
	if(res == 0){
		alert('请选择目录名');
	}else{
		alert(res);
   		location.href="./study.php";
	} 
  });
return false;
});
</script>
</html>