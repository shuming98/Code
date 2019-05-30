<?php 
session_start();
require('./lib/init.php');

if(isset($_SESSION['user_account'])){
	//查询用户数据
	$sql = "select user_data.user_account,user_nick,gender,tel,class,pic_path from user inner join user_data on user.user_account=user_data.user_account where user_data.user_account='$_SESSION[user_account]'";
	$user = mGetRow($sql);

	//输出某个学生任教老师名字
	if(!empty($user['class'])){
		$sql2 = "select user_nick from user_data where user_account=(select user_account from teacher where t_class='$user[class]')";
		$t_name = mGetOne($sql2);
	}

	//查询所有班级名字
	$sql3 = "select t_class from teacher group by t_class";
	$t_class = mGetAll($sql3);

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
$sql7 = "select id,title,link,pubtime from home_news where cat_id=1 order by id desc limit 0,12";
$hots_news = mGetAll($sql7);

//查询优秀学生作品
$sql8 = "select id,title,link,pubtime from home_news where cat_id=2 order by id desc limit 0,8";
$excellent_works = mGetAll($sql8);

//查询站外资讯
$sql9 = "select id,title,link,pubtime from home_news where cat_id=3 order by id desc limit 0,8";
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
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="renderer" content="webkit">
	<link rel="stylesheet" type="text/css" href="./css/public.css">
	<link rel="icon" href="./images/icon/labelLogo.jpg">
	<title>首页</title>
	<!--[if lte IE 9]>
          <script>location.href="./NoIE.html";</script>
    <![endif]-->
    <!--[if IE]>
	<link rel="stylesheet" type="text/css" href="./css/iebug.css">
    <![endif]-->
</head>
<body>
	<div class="header_pic">
		<div>
			<img class="header_logo" src="./images/icon/logo.png" alt="logo">
			<?php if($_SESSION['permission_id']==1){
				echo '<a class="go_admin" href="./manage/front/index.html">转去后台管理--&gt;&gt;</a>';
			} ?>		
		</div>
	</div>
	<!--导航栏-->
<div class="nav_bg">	
	<div class="nav">       
		<ul>
			<li><a href="./index.php"><img src="./images/icon/home.png" alt="home">首页</a></li>
			<li class="permit"><a href="./view/front/resource.php"><img src="./images/icon/resource.png" alt="resource">课程资源</a></li>
			<li class="permit"><a href="./view/front/study.php"><img src="./images/icon/study.png" alt="study">学习园地</a></li>
		<?php if($_SESSION['permission_id']==1 || $_SESSION['permission_id']==2){ ?>	
			<li class="permit"><a href="./view/front/check_work.php"><img src="./images/icon/work.png" alt="work">作业区</a></li>
		<?php }else { ?>
			<li class="permit"><a href="./view/front/show_work.php"><img src="./images/icon/work.png" alt="work">作业区</a></li>
		<?php } ?>
		<?php if($_SESSION['permission_id']==1 || $_SESSION['permission_id']==2){ ?>	
			<li><a href="./view/front/t_test.php"><img src="./images/icon/test.png" alt="test">发布试题</a></li>
		<?php }else{ ?>
			<li class="permit"><a href="./view/front/s_test.php"><img src="./images/icon/test.png" alt="test">试题练习</a></li>
		<?php } ?>	
			<li class="permit"><a href="./view/front/forum.php"><img src="./images/icon/forum.png" alt="forum">讨论区</a></li>
		</ul>

		<?php if(isset($_SESSION['user_account'])){ ?>

			<a class="user_message" onclick="document.getElementById('user').style.display = 'block'" href="#"><img src="<?php echo '.'.$user['pic_path']; ?>" alt="user"><?php echo $user['user_nick']; ?></a>

		<?php }else{ ?>

			<a class="nav_login" onclick="document.getElementById('login').style.display = 'block'" href="#"><img src="./images/icon/user.png" alt="login">登录</a>

		<?php } ?>

	</div>
</div>

	<!--模态框登录-->
	<div id="login" class="modal">
		<form class="modal_content animate" action="./view/admin/login.php" method="post">
			<div class="modal_img">
				<span onclick="document.getElementById('login').style.display = 'none'" class="close">&times;</span>
				<img src="./images/icon/user.png" alt="user">
			</div>
			<div class="modal_form">
				<p>账号:<input type="text" name="user_account" required="required" placeholder="请输入账号/学号" value="<?php echo $_COOKIE['account'];?>"></p>
				<p>密码:<input type="password" name="user_password" required="required" placeholder="请输入密码" style="margin-bottom:5px"> </p>
				<p style="font-size: 16px;"><label"><input type="checkbox" name="remember" checked><span style="margin-left:5px">记住账号</span></label></p>
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
				<div id="showImg"><label for="up_img"><img src="<?php echo '.'.$user['pic_path']; ?>" alt="img"></label></div>
			</div>
			<form class="user_modal_form" action="./view/admin/update_user_data.php" method="post" enctype="multipart/form-data">
				<span>上传头像:<input id="up_img" type="file" name="pic_path" accept="image/*" onchange="fileUpLoad(this);"></span>
				<p>账&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;号:<span class="user_data"><?php echo $user['user_account'];?></span></p>
				<p>用&nbsp;&nbsp;户&nbsp;名:<input type="text" name="user_nick" value="<?php echo $user['user_nick']; ?>" maxlength="9" required="required"></p>

				<p>性&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;别:<?php if(empty($user['gender'])){ ?>
					   <label><input name="gender" type="radio" value="男">男</label>
					   <label><input name="gender" type="radio" value="女">女</label>
				<?php }else{
						echo '<span class="user_data">',$user['gender'],'</span>';
					}?>
				</p>

				<p>联系方式:<input type="text" name="tel" value="<?php echo $user['tel']; ?>" maxlength="11" oninput="value=value.replace(/[^\d]/g,'')"><p>
			<?php if($_SESSION['permission_id']==1 || $_SESSION['permission_id']==2){ ?>
				<p>任教班级:<span class="user_data">
					<?php foreach($teacher_class as $v){
						echo $v['t_class'],',';
					}
					 ?>
				</span></p>
			<?php }else{ ?>	
				<p>班&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;级:<?php if(empty($user['class'])){?><select name="class">
			<?php foreach($t_class as $v){ ?>
					<option value="<?php echo $v['t_class']; ?>">
						<?php echo $v['t_class']; ?>				
					</option>
			<?php } ?>
				</select>
			<?php }else{
					echo '<span class="user_data">',$user['class'],'</span>';
					}?>
				</p>
				
				<p>任课老师:<?php if(!empty($t_name)){
					echo '<span class="user_data">',$t_name,'</span>';
					} ?>
				</p>
			<?php } ?>
			<a class="cpasswd" href="./view/admin/cpasswd.php">修改密码</a>
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
			<div class="news_nav">
				<img src="./images/icon/network.png" alt="network">
				<h1><?php echo $catname[0]['cat_name']; ?></h1>
				<a href="./view/front/more_news.php?news=1">更多&gt;&gt;</a>
			</div>
			<div class="clearfix"></div>
			<ul class="news_list">
			<?php foreach($hots_news as $v){ ?>
				<li>
					<span class="li_dot">&#8226;</span>
					<?php if($v['link'] == null){
						echo '<a href="./view/front/show_news.php?id=',$v['id'],'">',$v['title'],'</a>';
					}else{
						echo '<a href="',$v['link'],'" target="_blank">',$v['title'],'</a>';
					}
					echo '<span>',date('m-d',strtotime($v['pubtime'])),'</span>';
					?>
				</li>
			<?php } ?>
			</ul>
		</div>
		<div class=".clearfix"></div>
		
		<!--优秀学生作品-->
		<div class="excellent_works">
			<div class="news_nav">
				<img src="./images/icon/double-pen.png" alt="">
				<h1><?php echo $catname[1]['cat_name']; ?></h1>
				<a href="./view/front/more_news.php?news=2">更多&gt;&gt;</a>
			</div>
			<div class="clearfix"></div>
			<ul class="news_list">
			<?php foreach($excellent_works as $v){ ?>
				<li>
					<span class="li_dot">&#8226;</span>
					<?php if($v['link'] == null){
						echo '<a href="./view/front/show_news.php?id=',$v['id'],'">',$v['title'],'</a>';
					}else{
						echo '<a href="',$v['link'],'" target="_blank">',$v['title'],'</a>';
					}
					echo '<span>',date('m-d',strtotime($v['pubtime'])),'</span>';
					?>
				</li>
			<?php } ?>
			</ul>
		</div>

		<!--站外资讯-->
		<div class="outside_news">
			<div class="news_nav">
				<img src="./images/icon/article.png" alt="article">
				<h1><?php echo $catname[2]['cat_name']; ?></h1>
				<a href="./view/front/more_news.php?news=3">更多&gt;&gt;</a>
			</div>
		<div class="clearfix"></div>
		<ul class="news_list">
			<?php foreach($outside_news as $v){ ?>
				<li>
					<span class="li_dot">&#8226;</span>
					<?php if($v['link'] == null){
						echo '<a href="./view/front/show_news.php?id=',$v['id'],'">',$v['title'],'</a>';
					}else{
						echo '<a href="',$v['link'],'" target="_blank">',$v['title'],'</a>';
					}
					echo '<span>',date('m-d',strtotime($v['pubtime'])),'</span>';
					?>
				</li>
			<?php } ?>
			</ul>
		</div>
		<div class="clearfix"></div>
		
		<div class="excellent_line">
			<span class="rectangle"><img src="./images/icon/teacher.png" alt="teacher"><span>优秀教师</span></span><span class="right_tri"></span><span class="greater_than" style="color:#A7BBE3;">&gt;</span><span class="dashed_line">---------------------------------</span><span class="greater_than">&gt;</span><span><span>More</span></span>
		</div>
		<div class="clearfix"></div>
		<!--优秀师生-->
		<div class="excellent_figure">
			<div class="excellent_teachers">
			<?php foreach($excellentT as $v){ ?>
				<figure>
					<img src="<?php echo '.'.$v['pic_path']; ?>" alt="pic">
					<figcaption><?php echo $v['name']; ?></figcaption>
				</figure>
			<?php } ?>
			</div>
		</div>

		<div class="excellent_line">
			<span class="rectangle"><img src="./images/icon/student.png" alt="student"><span>优秀学生</span></span><span class="right_tri"></span><span class="greater_than" style="color:#A7BBE3;">&gt;</span><span class="dashed_line">---------------------------------</span><span class="greater_than">&gt;</span><span><span>More</span></span>
		</div>
		<div class="excellent_figure">
			<div class="excellent_students">
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
<script>
<?php if(!isset($_SESSION['user_account'])){ ?>
	var box = document.getElementsByClassName("permit");
	var i;
	for(i = 0;i < box.length; i++){
		box[i].addEventListener("click",function(){
			alert('请登录后在查看本页面内容');
		});
	}
<?php } ?>
//图片不可选择
window.onload = function(){
	var imgs = document.getElementsByTagName("img");
	for(var i=0;i<imgs.length;i++){
		imgs[i].oncontextmenu=function(){ return false;}
		imgs[i].ondragstart=function(){ return false;}
	}
}
</script>
</html>
