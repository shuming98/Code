<?php 
session_start();
require('../../lib/init.php');

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
$sql6 = "select count(*) from forum_comment where post_id = $post_id";
$sql7 = "select count(*) from forum_reply where post_id = $post_id";
$comment_sum = mGetOne($sql6);
$reply_sum = mGetOne($sql7) + $comment_sum;


//从地址栏获取当前页码
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

//设置每页显示回复数
$per_page_num = 5;


//根据id输出文章留言
$sql8 = "select floor_id,forum_comment.user_account,user_nick,pic_path,content,pubtime from forum_comment inner join user_data on forum_comment.user_account = user_data.user_account where post_id = $post_id and content !='' order by com_id asc" . ' limit ' . ($current_page-1)*$per_page_num . ',' . $per_page_num;
$comment = mGetAll($sql8);

$pages = getPage($comment_sum,$current_page,$per_page_num);

//防止用户乱输入url
// if(empty($post)){
// 	echo '<script>history.back();</script>';
// }else if($current_page>1 && empty($comment)){
// 	echo '<script>history.back();</script>';
// }
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../../css/public.css">
	<script src="../../js/jquery.js"></script>
	<title><?php echo $post[0]['post_title']; ?></title>
</head>
<body>
	<?php include('./nav.php'); ?>
	<div class="forum_show_container">
		<!--用户信息-->
		<div class="forum_show_left">
			<h1><?php echo '[',$post[0]['cat_name'],']',$post[0]['post_title']; ?></h1>
			<img src="<?php echo '../..',$post[0]['pic_path']; ?>" alt="头像">
			<p><?php echo $post[0]['user_nick']; ?></p><br/>
			<p><?php timeDiff($post[0]['pubtime']); ?></p>
		</div>
		<div class="forum_show_right">
			<button id="reply_btn">回复本帖</button>
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
			<?php echo '<p>浏览:',$viewsum,'&nbsp;&nbsp;&nbsp;回复:',$reply_sum,'&nbsp;&nbsp;&nbsp;点赞:',$likesum,'  </p>'; ?>
		</div>
		<div class="clearfix"></div>
		<div class="forum_show_content">
			<?php echo $post[0]['post_content']; ?>
		</div>
		<div class="forum_comment_content">
			<h1>全部回复(<?php echo $reply_sum; ?>)</h1>
		<?php foreach($comment as $v){ ?>
			<!--留言-->
			<div class="forum_one_comment">
				<img src="<?php echo '../..',$v['pic_path']; ?>" alt="头像">
				<p class="comment_left"><?php echo $v['user_nick'],' ',$v['floor_id'],'楼';
				if($_SESSION['permission_id'] == 1 || $v['user_account'] == $_SESSION['user_account']){
					echo '<button class="delete_comment_btn" value="',$v['floor_id'],'">删除</button>';
				}
				 ?></p><br/>
				<p class="comment_left"><?php timeDiff($v['pubtime']); ?></p>
				<div class="clearfix"></div>
				<div class="comment_content"><?php echo $v['content']; ?>
				<button class="reply_one_btn" value="<?php echo $v['floor_id']; ?>">回复</button>
				<div class="clearfix"></div>
				</div>				
				<!--回复-->
				<?php 
				$sql9 = "select com_id,forum_reply.user_account,user_nick,content from forum_reply inner join user_data on forum_reply.user_account = user_data.user_account where post_id = $post_id and floor_id = $v[floor_id] order by com_id asc";
				$reply = mGetAll($sql9);
				foreach($reply as $value){
				 ?>			 
				<div class="forum_one_reply">
					<span class="reply_nick"><?php echo $value['user_nick']; ?>：</span>
					<div class="reply_content"><?php echo $value['content']; ?></div>
					<?php if($_SESSION['permission_id'] == 1 || $value['user_account'] == $_SESSION['user_account']){
						echo '<button class="delete_reply_btn" value="',$value['com_id'],'">删除</button>';
					}
					 ?>
					<div class="clearfix"></div>
				</div>
				<?php } ?>
			</div>
		<?php } ?>
		</div>
		<!--分页页号-->
		<div id="page_bar" style="top:0px;">
			<?php 
				foreach($pages as $k=>$v){
					if($k == $current_page){
						echo '<span>',$k,'</span>';
					}else{
						echo '<a href="./forum_show.php?',$v,'">',$k,'</a>';
					}
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
			<input type="submit" value="回复">
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
document.getElementById('reply_btn').onclick = function(){
	var text = document.getElementsByClassName('forum_comment')[0];
	var reply = document.getElementsByClassName('forum_reply')[0];
	if(text.style.display == "none"){
		reply.style.display = "none";
		text.style.display = "block";
	}else{
		reply.style.display = "none";
		text.style.display = "none";
	}
   }

//关闭留言框
document.getElementById('reply_close').onclick = function(){
	var text = document.getElementsByClassName('forum_reply')[0];
		text.style.display = "none";
   }

//关闭回复框
document.getElementById('comment_close').onclick = function(){
	var text = document.getElementsByClassName('forum_comment')[0];
		text.style.display = "none";
   }

//ajax回复
$(".reply_one_btn").bind('click',function(event){
	$(".forum_reply").css('display','block');
	reply.ready(function() {
	  reply.setContent('回复'+event.target.value+'楼:');
});
	$("#reply_form").submit(function(){
		var data={
		'content':reply.getContent().replace('回复'+event.target.value+'楼:','')
		};

	$.post('../admin/add_comment.php?post_id=<?php echo $post_id;?>&floor_id='+event.target.value,data,function(res){
		location.reload();
	});
	return false;
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
	})
})

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