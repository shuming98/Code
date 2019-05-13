<?php 
session_start();
require('./lib/init.php');

if(isset($_SESSION['user_account'])){
	//查询用户数据
	$sql = "select user_data.user_account,user_nick,gender,tel,class,teacher,pic_path from user inner join user_data on user.user_account=user_data.user_account where user_data.user_account='$_SESSION[user_account]'";
	$user = mGetRow($sql);


	//查询所有班级名字
	$sql2 = "select t_class from teacher group by t_class";
	$t_class = mGetAll($sql2);


	//查询所有老师名字
	$sql3 = "select t_name from teacher group by t_name";
	$t_name = mGetAll($sql3);


	//查看某个老师教的班级名字
	$sql4 = "select t_class from teacher where user_account='$_SESSION[user_account]'";
	$teacher_class = mGetAll($sql4);
}

//输出前n张轮播图
$sql5 = "select content,pic_path from slideshow order by id desc limit 0,5";
$slideshow = mGetAll($sql5);
$slide_num = count($slideshow);

//输出资讯分类
$sql6 = "select id,cat_name from news_cat order by id asc limit 0,3";
$catname = mGetAll($sql6);

//查询最新资讯
$sql7 = "select id,title,link,pubtime from home_news where cat_id=1 order by id desc limit 0,6";
$hots_news = mGetAll($sql7);

//查询优秀学生作品
$sql8 = "select id,title,link,pubtime from home_news where cat_id=2 order by id desc limit 0,6";
$excellent_works = mGetAll($sql8);

//查询站外资讯
$sql9 = "select id,title,link,pubtime from home_news where cat_id=3 order by id desc limit 0,6";
$outside_news = mGetAll($sql9);

//查询优秀老师
$sql10 = "select name,pic_path from excellent where identify=1 order by id desc limit 0,3";
$excellentT = mGetAll($sql10);

//查询优秀学生
$sql11 = "select name,pic_path from excellent where identify=3 order by id desc limit 0,3";
$excellentS = mGetAll($sql11);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="./css/public.css">
	<title>首页</title>
</head>
<body>
	<!--导航栏-->
	<div class="nav">
		<img class="nav_logo" src="./images/icon/logo.png" alt="logo">
		<ul>
			<li><a href="./index.php"><img src="./images/icon/home.png" alt="home">首页</a></li>
			<li><a href="./view/front/resource.php"><img src="./images/icon/resource.png" alt="resource">课程资源</a></li>
			<li><a href="./view/front/study.php"><img src="./images/icon/study.png" alt="study">学习园地</a></li>
		<?php if($_SESSION['permission_id']==1 || $_SESSION['permission_id']==2){ ?>	
			<li><a href="./view/front/check_work.php"><img src="./images/icon/work.png" alt="work">作业区</a></li>
		<?php }else { ?>
			<li><a href="./view/front/show_work.php"><img src="./images/icon/work.png" alt="work">作业区</a></li>
		<?php } ?>
		<?php if($_SESSION['permission_id']==1 || $_SESSION['permission_id']==2){ ?>	
			<li><a href="./view/front/t_test.php"><img src="./images/icon/about.png" alt="about">发布试题</a></li>
		<?php }else{ ?>
			<li><a href="./view/front/s_test.php"><img src="./images/icon/about.png" alt="about">试题练习</a></li>
		<?php } ?>	
			<li><a href="./view/front/forum.php"><img src="./images/icon/forum.png" alt="forum">讨论区</a></li>
		</ul>
			<form action="#" method="get">		
				<input type="search" name="search" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;搜索...">
			</form>

		<?php if(isset($_SESSION['user_account'])){ ?>

			<a class="user_message" onclick="document.getElementById('user').style.display = 'block'" href="#"><img src="<?php echo '.'.$user['pic_path']; ?>" alt="user"><?php echo $user['user_nick']; ?></a>

		<?php }else{ ?>

			<a class="nav_login" onclick="document.getElementById('login').style.display = 'block'" href="#"><img src="./images/icon/user.png" alt="login">登录</a>

		<?php } ?>

	</div>

	<!--模态框登录-->
	<div id="login" class="modal">
		<form class="modal_content animate" action="./view/admin/login.php" method="post">
			<div class="modal_img">
				<span onclick="document.getElementById('login').style.display = 'none'" class="close">&times;</span>
				<img src="./images/icon/user.png" alt="user">
			</div>
			<div class="modal_form">
				<p><b>账号</b>:<input type="text" name="user_account" required="required" placeholder="请输入账号/学号" value="<?php echo $_COOKIE['account'];?>"></p>
				<p><b>密码</b>:<input type="password" name="user_password" required="required" placeholder="请输入密码"> </p>
				<p><input type="checkbox" name="remember" checked>记住账号<a href="#">忘记密码?</a></p>
				<input type="submit" value="登录">
			</div>				
		</form>
	</div>
	<div class="clearfix"></div>
		<!--用户信息-->
	<div id="user" class="modal">
		<div class="user_modal_content animate">
			<div class="user_modal_img">
				<span onclick="document.getElementById('user').style.display = 'none'"  class="close">&times;</span>
				<div id="showImg"><img src="<?php echo '.'.$user['pic_path']; ?>" alt="img"></div>
			</div>

			<form class="user_modal_form" action="./view/admin/update_user_data.php" method="post" enctype="multipart/form-data">
				<span>上传头像：<input id="up_img" type="file" name="pic_path" accept="image/*" onchange="fileUpLoad(this);"></span>
				<p>账&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;号：<?php echo $user['user_account'];?></p>
				<p>用&nbsp;&nbsp;户&nbsp;名：<input type="text" name="user_nick" value="<?php echo $user['user_nick']; ?>" maxlength="9"></p>

				<p>性&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;别：
				<?php if(empty($user['gender'])){ ?>
					   <input name="gender" type="radio" value="男">男
					   <input name="gender" type="radio" value="女">女
				<?php }else{
						echo $user['gender'];
					}?>
				</p>

				<p>联系方式：<input type="text" name="tel" value="<?php echo $user['tel']; ?>" maxlength="11" oninput="value=value.replace(/[^\d]/g,'')"><p>
			<?php if($_SESSION['permission_id']==1 || $_SESSION['permission_id']==2){ ?>
				<p>任教班级：
					<?php foreach($teacher_class as $v){
						echo $v['t_class'],',';
					}
					 ?>
				</p>
			<?php }else{ ?>	
				<p>班&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;级：
					<?php if(empty($user['class'])) {?>
				<select name="class">
			<?php foreach($t_class as $v){ ?>
					<option value="<?php echo $v['t_class']; ?>">
						<?php echo $v['t_class']; ?>				
					</option>
			<?php } ?>
				</select>
			<?php }else{
					echo $user['class'];
					}?>
				</p>
				
				<p>任课老师：
					<?php if(empty($user['teacher'])){ ?>
				<select name="teacher">
			<?php foreach($t_name as $v){ ?>
					<option value="<?php echo $v['t_name']; ?>">
						<?php echo $v['t_name']; ?>
					</option>
			<?php } ?>
				</select>
			<?php }else{
					echo $user['teacher'];
					} ?>
				</p>
			<?php } ?>
				<input type="submit" value="修改信息">
			</form>

			<a href="./view/admin/logout.php"><button>退出登录</button></a>
	</div>		
		</div>
	<div class="clearfix"></div>

	<!--首页内容-->
	<div class="index_container">
		<!--轮播图-->
		<div class="slideshow_container">
		<?php foreach($slideshow as $k=>$v){ ?>
			<div class="slides fade">
				<div class="numbertext"><?php echo $k+1,' / ',$slide_num; ?></div>
				<img src="<?php echo '.'.$v['pic_path']; ?>" alt="">
				<div class="slideshow_text"><?php echo $v['content']; ?></div>
			</div>
		<?php } ?>
		</div>

		<!--最新资讯-->
		<div class="hots_news">
			<h1><?php echo $catname[0]['cat_name']; ?><a href="./view/front/more_news.php?news=1">&gt;&gt;更多</a></h1>
			<div class="clearfix"></div>
			<hr>
			<ul class="list_news">
			<?php foreach($hots_news as $v){ ?>
				<li>
					<?php if($v['link'] == null){
						echo '<a href="./view/front/show_news?id=',$v['id'],'">',$v['title'],'</a>';
					}else{
						echo '<a href="',$v['link'],'" target="_blank">',$v['title'],'</a>';
					}
					echo '<span>',date('m/d',strtotime($v['pubtime'])),'</span>';
					?>
				</li>
			<?php } ?>
			</ul>
		</div>
		<div class=".clearfix"></div>
		
		<!--优秀学生作品-->
		<div class="excellent_works">
			<h1><?php echo $catname[1]['cat_name']; ?><a href="./view/front/more_news.php?news=2">&gt;&gt;更多</a></h1>
			<div class="clearfix"></div>
			<hr>
			<ul class="list_news">
			<?php foreach($excellent_works as $v){ ?>
				<li>
					<?php if($v['link'] == null){
						echo '<a href="./view/front/show_news?id=',$v['id'],'">',$v['title'],'</a>';
					}else{
						echo '<a href="',$v['link'],'" target="_blank">',$v['title'],'</a>';
					}
					echo '<span>',date('m/d',strtotime($v['pubtime'])),'</span>';
					?>
				</li>
			<?php } ?>
			</ul>
		</div>

		<!--站外资讯-->
		<div class="outside_news">
		<h1><?php echo $catname[2]['cat_name']; ?><a href="./view/front/more_news.php?news=3">&gt;&gt;更多</a></h1>
		<div class="clearfix"></div>
		<hr>
		<ul class="list_news">
			<?php foreach($outside_news as $v){ ?>
				<li>
					<?php if($v['link'] == null){
						echo '<a href="./view/front/show_news?id=',$v['id'],'">',$v['title'],'</a>';
					}else{
						echo '<a href="',$v['link'],'" target="_blank">',$v['title'],'</a>';
					}
					echo '<span>',date('m/d',strtotime($v['pubtime'])),'</span>';
					?>
				</li>
			<?php } ?>
			</ul>
		</div>
		<div class="clearfix"></div>

		<!--优秀师生-->
		<div class="excellent_figure">
			<div class="excellent_teachers">
				<h1>优秀老师</h1>
				<hr>
			<?php foreach($excellentT as $v){ ?>
				<figure>
					<img src="<?php echo '.'.$v['pic_path']; ?>" alt="pic">
					<figcaption><?php echo $v['name']; ?></figcaption>
				</figure>
			<?php } ?>
			</div>

			<div class="excellent_students">
				<h1>优秀学生</h1>
				<hr>
			<?php foreach($excellentS as $v){ ?>
				<figure>
					<img src="<?php echo '.'.$v['pic_path']; ?>" alt="">
					<figcaption><?php echo $v['name']; ?></figcaption>
				</figure>
			<?php } ?>
			</div>
		</div>
	</div>
	<footer class="footer">
		<p>© 2019 All right reserved.Development by 402.</p>
		<p>粤ICP备18036003号</p>
	</footer>
</body>
<script src="./js/home.js"></script>
</html>
