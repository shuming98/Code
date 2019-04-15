<?php session_start(); ?>
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
		<button>公告</button>
		<button>精品</button>
		<button>求助</button>
		<button>分享</button>
		<button>我要发帖</button>
	</div>
	<div class="clearfix"></div>
	<!--置顶公告-->
	<div class="forum_top_notice">
		<div class="forum_one_notice">
			<a href="#"><p>[公告]本讨论区须知事项</p><span>管理员 2019/5/25</span></a><br/>
			<a href="#"><p>[公告]本讨论区须遵守协议</p><span>管理员 2019/5/26</span></a><br/>
			<a href="#"><p>[公告]本讨论区新手使用教程</p><span>管理员 2019/5/27</span></a><br/>
			<a href="#"><p>[精品]工作三年月薪18K师兄经验分享</p><span>梁师兄 2019/6/05</span></a><br/>
		</div>
	</div>
	<!--讨论帖子区-->
		<div class="forum_content">
			<div class="forum_one_message">
				<div class="forum_message_left">
					<img src="../../images/icon/work.png" alt="">
					<p><a href="#">[求助]安装JDK时出现以下报错，如何解决</a></p>
					<p>陈同学 <span>2019/5/25</span></p>
				</div>
				<div class="forum_message_right">
					<p>最后回复：梁老师 <span>2019/5/29</span></p>
					<p>赞：5 回复：13 浏览：42</p>
				</div>
			</div>
			<div class="forum_one_message">
				<div class="forum_message_left">
					<img src="../../images/icon/work.png" alt="">
					<p><a href="#">[分享]Eclipse火星版(中文版)资源分享</a></p>
					<p>梁同学 <span>2019/5/28</span></p>
				</div>
				<div class="forum_message_right">
					<p>最后回复：李同学 <span>2019/5/29</span></p>
					<p>赞：15 回复：2 浏览：72</p>
				</div>
			</div>
		</div>
		<!--分页-->
	<p style="text-align: center;font-size: 18px;position:relative;top:200px;">1 2 3 4 5 &gt;</p>
	</div>
	<!--页脚-->
	<?php include('./foot.html'); ?>
</body>
<script src="../../js/main.js" type="text/javascript" charset="utf-8"></script>
</html>