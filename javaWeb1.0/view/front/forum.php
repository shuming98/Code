<?php 
session_start();
require('../../lib/acc_user.php');
require('../../lib/init.php');

//查询论坛分类
$sql = "select cat_id,cat_name from forum_cat";
$cat_name = mGetAll($sql);

//查询公告文章
$sql2 = "select user_nick,post_id,cat_name,post_title,pubtime from forum_post inner join user_data on forum_post.user_account = user_data.user_account where cat_name = '公告' limit 0,3";
$notice = mGetAll($sql2);
/**
 * 实现分页功能
 */

//查询帖子总数
$sql3 = "select count(*) from forum_post";
$post_sum = mGetOne($sql3);

//设置每页显示帖子数
$per_page_num = 12;

//从地址栏获得当前页码
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;


//判断地址栏是否有cat_id,并调用分页函数
if(isset($_GET['cat_id'])){
	if(empty(in_array($_GET['cat_id'],array_column($cat_name,cat_id)))){
		header('Location:../../404.html');
		exit;
	}

	//查询单个分类的帖子数
	$sql4 = "select count(*) from forum_post left join forum_cat on forum_post.cat_name = forum_cat.cat_name where cat_id = $_GET[cat_id]";
	$cat_post_sum = mGetOne($sql4);
	$where = " where cat_id = $_GET[cat_id] order by post_id desc";
	$pages = getPage($cat_post_sum,$current_page,$per_page_num);
}else{
	$where = " order by post_id desc";
	$pages = getPage($post_sum,$current_page,$per_page_num);
}

//查询所有帖子
$sql9 = "select post_nick,t8.post_id,t9.cat_id,t8.cat_name,post_title,post_time,reply_nick,reply_time,likes,reply_sum from (select post_nick,t6.post_id,cat_name,post_title,post_time,reply_nick,reply_time,likes,reply_sum from(select t3.post_nick,t3.post_id,t3.cat_name,t3.post_title,t3.post_time,t3.reply_nick,t3.reply_time,t4.likes from (select t1.user_nick as post_nick,t1.post_id,t1.cat_name,t1.post_title,t1.pubtime as post_time,t2.user_nick as reply_nick,t2.max_pubtime as reply_time from (select user_nick,post_id,cat_name,post_title,pubtime from forum_post inner join user_data on forum_post.user_account = user_data.user_account) as t1 left join (select user_nick,post_id,max(pubtime) as max_pubtime from forum_comment inner join user_data on forum_comment.user_account = user_data.user_account group by post_id) as t2 on t1.post_id=t2.post_id) as t3 left join (select post_id,count(*) as likes from give_a_like group by post_id) as t4 on t3.post_id=t4.post_id) as t6 left join (select post_id,count(*) as reply_sum from (select post_id from forum_comment where content!='' union all select post_id from forum_reply) as t5 group by post_id) as t7 on t6.post_id=t7.post_id) as t8 left join (select cat_id,cat_name from forum_cat) as t9 on t8.cat_name = t9.cat_name" . $where . ' limit ' . ($current_page-1)*$per_page_num . ',' . $per_page_num;;
$post = mGetAll($sql9);

if(empty($post) && isset($_GET['page'])){
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
	<link rel="icon" href="../../images/icon/labelLogo.jpg">
	<link rel="stylesheet" type="text/css" href="../../css/public.css">
	<title>讨论区</title>
</head>
<body style="background:#fff;">
	<?php include('./nav.php'); ?>
	<!--讨论区-->
	<div class="forum_container">
	<div class="forum_img"><img src="../../images/icon/javaForum.png" alt="forum"></div>
	<div class="forum_category">
	<?php 
		foreach($cat_name as $v){
			echo '<a href="./forum.php?cat_id=',$v['cat_id'],'">',$v['cat_name'],'</a>';
		}
	 ?>
		<a href="./add_post.php"><img src="../../images/icon/add-post.png" alt="post">我要发帖</a>
	</div>
	<div class="clearfix"></div>
	<!--置顶公告-->
	<div class="forum_top_notice">
		<div class="forum_one_notice">
		<?php foreach($notice as $v){ 
			echo '<span class=
			"li_dot" style="margin-right:-10px;position:relative;top:5px ;left:30px;color:#748FC9">&#8226;</span><p><a href="./forum_show.php?post_id=',$v['post_id'],'">','[',$v['cat_name'],']',$v['post_title'],'</a><span>',$v['user_nick'],' ',timeDiff($v['pubtime']),'</span></p>';
		} ?>
		</div>
	</div>
	<!--讨论帖子区-->
		<div class="forum_content">
		<?php foreach($post as $v){ 
			if($v['likes'] == null){
				$v['likes'] = 0;
			}
			if($v['reply_sum'] == null){
				$v['reply_sum'] = 0;
			}
		//查询浏览数
		$sql10 = "select count(*) from pageview where symbol = 'post_$v[post_id]'";
		$pageview = mGetOne($sql10);
			?>
			<div class="forum_one_message">
				<div class="forum_message_left">
					<p><a href="./forum_show.php?post_id=<?php echo $v['post_id']; ?>"><?php echo '<span class="post_cat">[',$v['cat_name'],']</span>',$v['post_title'];?></a></p>
					<?php echo '<p>',$v['post_nick'],' <span>',timeDiff($v['post_time']),'</span>','<span class="post_message"><span class="post_message_pageview"><img src="../../images/icon/view.png" alt="like">',$pageview,'</span><span class="post_message_replysum"><img src="../../images/icon/comment.png" alt="like">',$v['reply_sum'],'</span><span class="post_message_like"><img src="../../images/icon/like.png" alt="like">',$v['likes'],'</span></span></p>';?>
				</div>
				<div class="forum_message_right">
					<?php 
					echo '<p>最后回复:',$v['reply_nick'],'</p>','<p>',timeDiff($v['reply_time']),'</p>'
					?>
				</div>
			</div>
		<?php } ?>
	</div>
</div>
	<!-- 分页页号 -->
	<div style="width:1300px;margin:auto">	
		<div id="page_bar" style="float:right;width:auto;margin-top:15px;">
			<?php 
				if($current_page>1){
					$_GET['page']=$current_page-1;
					echo '<a style="font-size:24px" href="./forum.php?',http_build_query($_GET),'">&lt;</a>';
			}
				foreach($pages as $k=>$v){
					if($k == $current_page){
						echo '<span style="font-size:24px">',$k,'</span>';
					}else{
						echo '<a style="font-size:24px" href="./forum.php?',$v,'">',$k,'</a>';
					}
				}
				end($pages);
				if($current_page<key($pages)){
				$_GET['page']=$current_page+1;
				echo '<a style="font-size:24px" href="./forum.php?',http_build_query($_GET),'">&gt;</a>';
			}
			?>
		</div>
	</div>
	<!--页脚-->
	<?php include('./foot.html'); ?>
</body>
</html>