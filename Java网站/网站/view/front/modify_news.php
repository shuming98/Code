<?php 
session_start();
require('../../lib/init.php');

//防止非法入侵
if($_SESSION['permission_id']!=0 && $_SESSION['permission_id']!=1){
	echo "<script>alert('此非你该来的地方');</script>";
	echo "<script>location.replace('../../home.php');</script>";
	exit;
}

//获取资讯id并查询该资讯内容
$news_id = $_GET['id'];
$sql = "select title,cat_id,content from home_news where id = $news_id";
$news = mGetAll($sql);
var_dump($news);

//查询分类名
$sql2 = "select id,cat_name from news_cat order by id asc limit 0,3";
$catname = mGetAll($sql2);
var_dump($catname);
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../../css/public.css">
	<script src="../../js/jquery.js"></script>
	<title>修改资讯</title>
</head>
<body>
	<?php include('./nav.php'); ?>
	<!-- 发布文章容器 -->
	<div class="study_add_article">
		<p><a href="../../index.php">首页</a>&gt;<span>修改资讯</span></p>
		<form id="news_form" method="post" action="../../manage/admin/add_news.php?id=<?php echo $news_id;?>">
			<input type="text" name="title" placeholder="请输入资讯标题" value="<?php echo $news[0]['title'];?>" required="required" maxlength="30">
			<!--加载编辑器的容器-->
			<script id="container" name="content" type="text/plain"><?php echo $news[0]['content']; ?></script>
				<select name="news_id">
					<option value="default">选择分类</option>
			<?php foreach($catname as $v){ 
				echo '<option value="',$v['id'],'"',$v['id']==$news[0]['cat_id']?' selected="selected"':'','>',$v['cat_name'],'</option>';
				}?>
				</select>
			<input type="submit" value="确定">
		</form>
		</div>
	<?php include('./foot.html'); ?>
</body>
<!-- 配置文件 -->
<script type="text/javascript" src="../../ueditor/utf8-php/ueditor.config.js"></script>
<!-- 编辑器源码文件 -->
<script type="text/javascript" src="../../ueditor/utf8-php/ueditor.all.min.js"></script>
<!-- 实例化编辑器 -->
<script type="text/javascript">
    var ue = UE.getEditor('container', {
    toolbars: [
    ['undo','redo','removeformat','|','bold','italic','underline','strikethrough','horizontal','|','fontsize','forecolor','backcolor','|','indent','justifyleft','justifycenter','justifyright','|','insertorderedlist','insertunorderedlist','|','insertcode','simpleupload','fullscreen','attachment','link','unlink','drafts','|','preview','help']
	],
	autoHeightEnabled: false,
    autoFloatEnabled: false
});
    ue.ready(function(){
    	ue.setHeight(500);
    });

//ajax
$("#news_form").submit(function(){
  var data={
    'title':$("#news_form input[name='title']").val(),
    'content':ue.getContent(),
    'news_id':$("#news_form select[name='news_id']").val()
	};
$.post('../../manage/admin/add_news.php?id=<?php echo $news_id;?>',data,function(res){
    	alert(res);
    	location.href="./show_news?id=<?php echo $news_id; ?>";
  	});
return false;
});
</script>
</html>