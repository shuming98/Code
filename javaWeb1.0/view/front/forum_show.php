<?php 
session_start();
require('../../lib/acc_user.php');
require('../../lib/init.php');

if(isset($_GET['post_id'])){
	$post_id = $_GET['post_id'];
	//每个用户访问,浏览数+1
	$pageview['ip'] = sprintf('%u',ip2long(getRealIp()));
	$pageview['symbol'] = "post_$post_id";

	$sql = "select count(*) from pageview where symbol = '$pageview[symbol]' and ip = $pageview[ip]";
	if(mGetOne($sql) == 0){
		mExec('pageview',$pageview);
	}

	//根据id查询文章内容
	$sql2 = "select forum_post.user_account,user_nick,pic_path,post_title,cat_name,post_content,pubtime from forum_post inner join user_data on forum_post.user_account = user_data.user_account where post_id = $_GET[post_id]";
	$post = mGetAll($sql2);

	//防止用户乱输入url
	if(empty($post)){
		header('Location:../../404.html');
		exit;
	}

	//获取文章访问数
	$sql3 = "select count(*) from pageview where symbol='$pageview[symbol]'";
	$viewsum = mGetOne($sql3);

	//获取文章点赞数
	$sql4 = "select count(*) from give_a_like where post_id = $post_id";
	$likesum = mGetOne($sql4);

	/**
	 * 实现分页功能
	 */

	//回帖数&&统计所有回复数
	$sql6 = "select count(*) from forum_comment where post_id = $post_id and content !=''";
	$sql7 = "select count(*) from forum_reply where post_id = $post_id";
	$comment_sum = mGetOne($sql6);
	$reply_sum = mGetOne($sql7) + $comment_sum;


	//从地址栏获取当前页码
	$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

	//设置每页显示回复数
	$per_page_num = 12;


	//根据id输出文章留言
	$sql8 = "select floor_id,forum_comment.user_account,user_nick,pic_path,content,pubtime from forum_comment inner join user_data on forum_comment.user_account = user_data.user_account where post_id = $post_id and content !='' order by com_id asc" . ' limit ' . ($current_page-1)*$per_page_num . ',' . $per_page_num;
	$comment = mGetAll($sql8);

	$pages = getPage($comment_sum,$current_page,$per_page_num);

	//防止用户乱输入url
	if(empty($comment) && isset($_GET['page'])){
		header('Location:../../404.html');
		exit;
	}
}else{
	header('Location:../../404.html');
	exit;
}

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="renderer" content="webkit">
	<link rel="stylesheet" type="text/css" href="../../css/public.css">
	<link rel="icon" href="../../images/icon/labelLogo.jpg">
	<script src="../../js/jquery.js"></script>
	<title><?php echo $post[0]['post_title']; ?></title>
</head>
<body style="background: #f8f9fa">
	<?php include('./nav.php'); ?>
	<div class="forum_show_container">
		<!--用户信息-->
		<div class="forum_show_title">
			<h1><?php echo '[',$post[0]['cat_name'],']',$post[0]['post_title']; ?></h1>
			<div class="forum_show_button">
				<button class="comment_btn">回复本帖</button>
				<button id="like_btn">点赞</button>
				<?php 
				if($_SESSION['permission_id'] == 1){
					echo '<button id="set_jp_btn">设为精品</button>';
				}
				if($post[0]['user_account'] == $_SESSION['user_account']){?>
					<button id="modify_btn" onclick="location.href='./modify_post.php?post_id=<?php echo $post_id;?>'">修改</button>
				<?php }
				if($_SESSION['permission_id'] ==1 || $post[0]['user_account'] == $_SESSION['user_account']){
					echo '<button id="delete_btn">删帖</button>';
				}
				?>
		</div>	
		</div>
		<div class="clearfix"></div>
		<div class="forum_show_content">
			<div class="forum_show_content_left">
				<img src="<?php echo '../..',$post[0]['pic_path']; ?>" alt="pic">
				<p><?php echo $post[0]['user_nick']; ?></p>
			</div>
			<div class="forum_show_content_right">
				<?php echo '<p>浏览:',$viewsum,'&nbsp;&nbsp;&nbsp;回复:',$reply_sum,'&nbsp;&nbsp;&nbsp;点赞:',$likesum,'  </p>'; ?>
				<div style="min-height:100px"><?php echo $post[0]['post_content']; ?></div>
				<p><span class="floor_color">楼主</span><span class="time_color"><?php timeDiff($post[0]['pubtime']); ?></span><button class="comment_btn reply_color">回复</button></p>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="forum_comment_content">
		<?php foreach($comment as $v){ ?>
			<!--帖子留言-->
			<div class="forum_one_comment">
				<div class="forum_one_comment_left">
					<img src="<?php echo '../..',$v['pic_path']; ?>" alt="pic">
				<p><?php echo $v['user_nick']; ?></p>
				</div>
				<div class="forum_one_comment_right">
					<div style="min-height:100px;"><?php echo $v['content']; ?></div>
					<p class="floor_message">
					<?php
					if($_SESSION['permission_id'] == 1 || $v['user_account'] == $_SESSION['user_account']){
						echo '<button class="delete_comment_btn" value="',$v['floor_id'],'">删除</button>';
					}
				 ?><span class="floor_color"><?php echo $v['floor_id']; ?>楼</span><span class="time_color"><?php timeDiff($v['pubtime']); ?></span><button class="reply_one_btn" value="<?php echo $v['floor_id']; ?>">回复</button>
					</p>
					<div class="clearfix"></div>
					<!-- 楼层回复 -->
					<?php $sql9 = "select com_id,forum_reply.user_account,user_nick,content from forum_reply inner join user_data on forum_reply.user_account = user_data.user_account where post_id = $post_id and floor_id = $v[floor_id] order by com_id asc"; 
					$reply = mGetAll($sql9);
					foreach($reply as $value){
					?>
					<div class="forum_one_reply">
						<span class="reply_nick"><?php echo $value['user_nick']; ?>：</span>
						<div class="reply_content"><?php echo $value['content']; ?></div>
						<?php if($_SESSION['permission_id'] == 1 || $value['user_account'] == $_SESSION['user_account']){
						echo '<button class="delete_reply_btn" value="',$value['com_id'],'">删除</button>';
					}?>
					<div class="clearfix"></div>
					</div>
				<?php } ?>
				</div>
		</div>
		<?php } ?>
	</div>
		<!--分页页号-->
		<div id="page_bar" style="margin-top:10px;float:right;width:auto">
			<?php 
				if($current_page>1){
					$_GET['page']=$current_page-1;
					echo '<a style="font-size:24px" href="./forum_show.php?',http_build_query($_GET),'">&lt;</a>';
				}
				foreach($pages as $k=>$v){
					if($k == $current_page){
						echo '<span>',$k,'</span>';
					}else{
						echo '<a href="./forum_show.php?',$v,'">',$k,'</a>';
					}
				}
				end($pages);
				if($current_page<key($pages)){
				$_GET['page']=$current_page+1;
				echo '<a style="font-size:24px" href="./forum_show.php?',http_build_query($_GET),'">&gt;</a>';
				}
			?>
		</div>
</div>
	<!--留言窗口-->
	<div class="forum_comment">
		<form id="comment_form" method="post" accept-charset="utf-8">
			<textarea id="container" name="content" required="required"></textarea>
			<span id="comment_close">关闭</span>
			<input type="submit" value="回复本帖">
		</form>	
	</div>
	<!--回复窗口-->	
	<div class="forum_reply">
		<form id="reply_form" method="post" accept-charset="utf-8">
			<textarea id="reply_container" name="content" required="required"></textarea>
			<span id="reply_close">关闭</span>
			<input type="submit" value="回复楼层">
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
    ['emotion','insertcode','simpleupload']
	],
	autoHeightEnabled: false,
    autoFloatEnabled: false,
    initialFrameHeight:200
});

var reply = UE.getEditor('reply_container', {
    toolbars: [
    ['emotion','insertcode']
	],
	autoHeightEnabled: false,
    autoFloatEnabled: false,
    initialFrameHeight:200
});


//打开留言框
$(".comment_btn").click(function(){
	$(".forum_reply").css('display','none');
	$(".forum_comment").css('display','block');
});



//关闭留言框
$("#comment_close").click(function(){
	$(".forum_comment").css('display','none');
});

//关闭回复框
$("#reply_close").click(function(){
	$(".forum_reply").css('display','none');
});

//ajax回复
$(".reply_one_btn").click(function(event){
	$(".forum_comment").css('display','none');
	$(".forum_reply").css('display','block');
	reply.ready(function() {
	  reply.setContent('回复'+event.target.value+'楼:');
});
	$("#reply_form").unbind('submit').submit(function(){
		var data={
			'content':reply.getContent().replace('回复'+event.target.value+'楼:','')
			};
		$.post('../admin/add_comment.php?post_id=<?php echo $post_id;?>&floor_id='+event.target.value,data,function(res){
			location.reload();
		});
	});
});


//ajax留言
$("#comment_form").submit(function(){
var data={
    'content':ue.getContent()
};
$.post('../admin/add_comment.php?post_id=<?php echo $post_id;?>',data,function(res){
   location.reload();
  });
return false;
});

//ajax 点赞
$("#like_btn").bind('click',function(){
	$.get('../admin/give_a_like.php?post_id='+<?php echo $post_id; ?>,function(data){
			$("#like_btn").text(data);
			$("#like_btn").attr("disabled","true");
	});
});

//ajxa 设置精品贴
$('#set_jp_btn').bind('click',function(){
	$.get('../admin/set_jp.php?post_id='+<?php echo $post_id;?>,function(data){
			$("#set_jp_btn").text(data);
			$("#set_jp_btn").attr("disabled","true");
	});
});

//ajax 删帖
$("#delete_btn").bind('click',function(){
	$.get('../admin/delete_post.php?post_id='+<?php echo $post_id; ?>,function(data){
			alert(data);
			location.href = "./forum.php";
	});
});

//ajax 删除帖子回复
$(".delete_comment_btn").bind('click',function(event){
	$.get('../admin/delete_comment.php?post_id='+<?php echo $post_id; ?>+'&floor_id='+event.target.value,function(data){
			alert(data);
			location.reload();
	});
});

//ajax 删除楼层回复
$(".delete_reply_btn").bind('click',function(event){
	$.get('../admin/delete_comment.php?com_id='+event.target.value,function(data){
			alert(data);
			location.reload();
	});
});
</script>
</html>