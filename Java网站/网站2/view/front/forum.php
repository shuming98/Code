<?php 
session_start();
require('../../lib/acc_user.php');
require('../../lib/init.php');

//查询论坛分类
$sql = "select cat_id,cat_name from forum_cat";
$cat_name = mGetAll($sql);

echo $_GET['cat_name'];

//查询公告文章
$sql2 = "select user_nick,post_id,cat_name,post_title,pubtime from forum_post inner join user_data on forum_post.user_account = user_data.user_account where cat_name = '公告'";
$notice = mGetAll($sql2);

/**
 * 实现分页功能
 */

//查询帖子总数
$sql3 = "select count(*) from forum_post";
$post_sum = mGetOne($sql3);

//设置每页显示帖子数
$per_page_num = 8;

//从地址栏获得当前页码
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;


//判断地址栏是否有cat_id,并调用分页函数
if(isset($_GET['cat_id'])){
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
$sql9 = "select post_nick,t8.post_id,t9.cat_id,t8.cat_name,post_title,post_time,reply_nick,reply_time,likes,reply_sum from (select post_nick,t6.post_id,cat_name,post_title,post_time,reply_nick,reply_time,likes,reply_sum from(select t3.post_nick,t3.post_id,t3.cat_name,t3.post_title,t3.post_time,t3.reply_nick,t3.reply_time,t4.likes from (select t1.user_nick as post_nick,t1.post_id,t1.cat_name,t1.post_title,t1.pubtime as post_time,t2.user_nick as reply_nick,t2.max_pubtime as reply_time from (select user_nick,post_id,cat_name,post_title,pubtime from forum_post inner join user_data on forum_post.user_account = user_data.user_account) as t1 left join (select user_nick,post_id,max(pubtime) as max_pubtime from forum_comment inner join user_data on forum_comment.user_account = user_data.user_account group by post_id) as t2 on t1.post_id=t2.post_id) as t3 left join (select post_id,count(*) as likes from give_a_like group by post_id) as t4 on t3.post_id=t4.post_id) as t6 left join (select post_id,count(*) as reply_sum from (select post_id from forum_comment union all select post_id from forum_reply) as t5 group by post_id) as t7 on t6.post_id=t7.post_id) as t8 left join (select cat_id,cat_name from forum_cat) as t9 on t8.cat_name = t9.cat_name" . $where . ' limit ' . ($current_page-1)*$per_page_num . ',' . $per_page_num;;
$post = mGetAll($sql9);

if(empty($post)){
	header('Location:./forum.php');
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../../css/public.css">
	<title>讨论区</title>
</head>
<body>
	<?php include('./nav.php'); ?>
	<!--讨论区-->
	<div class="forum_container">
	<div class="forum_img"><img src="" alt="图片占位符"></div>
	<div class="forum_category">
	<?php 
		foreach($cat_name as $v){
			echo '<a href="./forum.php?cat_id=',$v['cat_id'],'">',$v['cat_name'],'</a>';
		}
	 ?>
		<a href="./add_post.php">我要发帖</a>
	</div>
	<div class="clearfix"></div>
	<!--置顶公告-->
	<div class="forum_top_notice">
		<div class="forum_one_notice">
		<?php foreach($notice as $v){ 
			echo '<p><a href="./forum_show?post_id=',$v['post_id'],'">','[',$v['cat_name'],']',$v['post_title'],'</a><span>',$v['user_nick'],' ',timeDiff($v['pubtime']),'</span></p>';
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
					<img src="../../images/icon/work.png" alt="">
					<p><a href="./forum_show?post_id=<?php echo $v['post_id']; ?>"><?php echo '[',$v['cat_name'],']',$v['post_title']; ?></a></p>
					<?php echo '<p>',$v['post_nick'],' <span>',timeDiff($v['post_time']),'</span>','</p>';?>
				</div>
				<div class="forum_message_right">
					<?php echo '<p>最后回复:',$v['reply_nick'],'&nbsp;&nbsp;',timeDiff($v['reply_time']),'</p>
					<p>赞:',$v['likes'],'&nbsp;&nbsp;&nbsp;&nbsp;回复:',$v['reply_sum'],'&nbsp;&nbsp;&nbsp;&nbsp;浏览:',$pageview,'</p>';?>
				</div>
			</div>
		<?php } ?>
	</div>
</div>
	<!-- 分页页号 -->
		<div id="page_bar" style="top:30px;">
			<?php 
				foreach($pages as $k=>$v){
					if($k == $current_page){
						echo '<span>',$k,'</span>';
					}else{
						echo '<a href="./forum.php?',$v,'">',$k,'</a>';
					}
				}
			?>
		</div>
	<!--页脚-->
	<?php include('./foot.html'); ?>
</body>
</html>