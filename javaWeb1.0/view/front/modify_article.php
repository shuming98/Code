<?php 
session_start();
require('../../lib/acc_teacher.php');
require('../../lib/init.php');

//获取文章id并查询该文章内容
$art_id = $_GET['art_id'];
$sql = "select dirname_id,art_title,art_content from article where art_id = $art_id";
$article = mGetAll($sql);
//查询目录名
$sql2 = "select dirname_id,dirname from study_dir where user_account = '$_SESSION[user_account]'";
$dirname = mGetAll($sql2);
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
	<title>修改文章</title>
</head>
<body style="background: #F8F8F8">
	<?php include('./nav.php'); ?>
	<!-- 发布文章容器 -->
	<div class="study_add_article">
		<div class="ue_line">	
			<span class="ue_nav"><span><a href="./study.php">学习园地</a></span></span><span class="ue_tri"></span><span class="ue_nav2"><span>修改文章</span></span><span class="ue_tri"></span>
		</div>
		<form id="article_form" method="post" action="../admin/add_article.php?art_id=<?php echo $art_id;?>">
			<input type="text" name="art_title" placeholder="请输入文章标题" value="<?php echo $article[0]['art_title'];?>" required="required" maxlength="30">
			<!--加载编辑器的容器-->
			<script id="container" name="content" type="text/plain"><?php echo $article[0]['art_content']; ?></script>
				<select name="dirname">
					<option value="0">选择目录</option>
			<?php foreach($dirname as $v){ 
				echo '<option value="',$v['dirname_id'],'"',$v['dirname_id']==$article[0]['dirname_id']?' selected="selected"':'','>',$v['dirname'],'</option>';
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
    ['undo','redo','removeformat','|','bold','italic','underline','strikethrough','horizontal','|','fontsize','forecolor','backcolor','|','indent','justifyleft','justifycenter','justifyright','|','insertorderedlist','insertunorderedlist','|','insertcode','simpleupload','fullscreen','attachment','drafts','|','preview']
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
$.post('../admin/add_article.php?art_id=<?php echo $art_id;?>',data,function(res){
		if(res == 0){
			alert('请选择目录名');
		}else{
			alert(res);
	   		location.href="./study.php?id=<?php echo $_GET['art_id']; ?>";
		} 
  	});
return false;
});
</script>
</html>