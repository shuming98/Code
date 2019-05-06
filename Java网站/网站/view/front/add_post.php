<?php 
session_start();
require('../../lib/init.php');

//查询论坛分类
if($_SESSION['permission_id'] == 0){
	$sql = "select cat_name from forum_cat";
	$cat_name = mGetAll($sql);
}else{
	$sql = "select cat_name from forum_cat where cat_id in (3,4)";
	$cat_name = mGetAll($sql);
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../../css/public.css">
	<script src="../../js/jquery.js"></script>
	<title>发布帖子</title>
</head>
<body>
	<?php include('./nav.php'); ?>
	<!-- 发布文章容器 -->
	<div class="forum_post">
		<p><a href="./forum.php">讨论区</a>&gt;<span>发帖</span></p>
		<form id="post_form" method="post" accept-charset="utf-8">
			<input type="text" name="post_title" placeholder="请输入标题" required="required" maxlength="30">
			<!--加载编辑器的容器-->
			<script id="container" name="content" type="text/plain"></script>
				<select name="cat_name">
			<?php foreach($cat_name as $v){ 
				echo '<option value="',$v['cat_name'],'">',$v['cat_name'],'</option>';
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
    ['bold','italic','underline','strikethrough','horizontal','|','fontsize','forecolor','backcolor','|','indent','justifyleft','justifycenter','justifyright','|','insertorderedlist','insertunorderedlist','|','insertcode','emotion','simpleupload','fullscreen','attachment','link','unlink','drafts','|','preview']
	],
	autoHeightEnabled: false,
    autoFloatEnabled: false
});
    ue.ready(function(){
    	ue.setHeight(500);
    });


//ajax
$("#post_form").submit(function(){
var data={
    'post_title':$("#post_form input[name='post_title']").val(),
    'content':ue.getContent(),
    'cat_name':$("#post_form select[name='cat_name']").val()
};
$.post('../admin/add_post.php',data,function(res){
    alert(res);
    history.back();
  });
return false;
});
</script>
</html>