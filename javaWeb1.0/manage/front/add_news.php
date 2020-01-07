<?php 
session_start();
require('../../lib/acc_admin.php');
require('../../lib/init.php');

//查询资讯分类
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
	<title>发布资讯</title>
</head>
<body>
	<?php include('./header.php'); ?>
	<div class="manage_container">
		<?php include('./sidenav.html'); ?>
		<div class="function">
			<div class="add_article_contianer">
				<h2 class="h2_title">发布资讯</h2>
				<span class="h2_line"></span>
				<!-- 发布文章容器 -->
				<div class="home_add_news">
					<form id="news_form" action="../admin/add_news.php" method="post" accept-charset="utf-8">
						<input type="text" name="title" placeholder="请输入资讯标题" required="required" maxlength="50">
						<!--加载编辑器的容器-->
						<script id="container" name="content" type="text/plain"></script>
							<select name="news_id">
								<option value="default">选择分类</option>
						<?php foreach($catname as $v){ 
							echo '<option value="',$v['id'],'">',$v['cat_name'],'</option>';
							}?>
							</select>
						<input type="submit" value="发布">
					</form>
					</div>
			</div>
		</div>
	</div>
	<?php include('./footer.html'); ?>
</body>
<!-- 配置文件 -->
<script type="text/javascript" src="../../ueditor/utf8-php/ueditor.config.js"></script>
<!-- 编辑器源码文件 -->
<script type="text/javascript" src="../../ueditor/utf8-php/ueditor.all.min.js"></script>
<!-- 实例化编辑器 -->
<script type="text/javascript">
    var ue = UE.getEditor('container', {
    toolbars: [
    ['undo','redo','removeformat','|','bold','italic','underline','strikethrough','horizontal','|','fontsize','forecolor','backcolor','|','indent','justifyleft','justifycenter','justifyright','|','insertorderedlist','insertunorderedlist','|','insertcode','simpleupload','fullscreen','attachment','link','unlink','drafts','|','preview']
	],
	autoHeightEnabled: false,
    autoFloatEnabled: false
});
    ue.ready(function(){
    	ue.setHeight(450);
    });

//ajax发布文章
$("#news_form").submit(function(){
var data={
    'title':$("#news_form input[name='title']").val(),
    'content':ue.getContent(),
    'news_id':$("#news_form select[name='news_id']").val()
};
$.post('../admin/add_news.php',data,function(res){
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