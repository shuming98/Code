<?php 
	if(!isset($_SESSION['user_account'])){
	 	echo "<script>alert('请登录后再查看本页面内容');</script>";
		echo "<script>location.replace('../../home.php');</script>";
	 }
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
?>
	<!--导航栏-->
	<div class="nav">
		<img class="nav_logo" src="../../images/icon/logo.png" alt="logo">
		<ul>
			<li><a href="../../home.php"><img src="../../images/icon/home.png" alt="home">首页</a></li>
			<li><a href="./resource.php"><img src="../../images/icon/resource.png" alt="resource">课程资源</a></li>
			<li><a href="./study.php"><img src="../../images/icon/study.png" alt="study">学习园地</a></li>
<?php if($_SESSION['permission_id']==0 || $_SESSION['permission_id']==1){ ?>
			<li><a href="./check_work.php"><img src="../../images/icon/work.png" alt="work">作业区</a></li>
<?php }else{ ?>			
			<li><a href="./show_work.php"><img src="../../images/icon/work.png" alt="work">作业区</a></li>
<?php } ?>
			<li><a href="./forum.php"><img src="../../images/icon/forum.png" alt="forum">讨论区</a></li>
			<li><a href="#"><img src="../../images/icon/about.png" alt="about">关于</a></li>
		</ul>
			<form action="#" method="get">	
				<input type="search" name="search" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;搜索...">
			</form>
		<a class="user_message" href="#" onclick="document.getElementById('user').style.display='block'"><img src="<?php echo '../..'.$user['pic_path']; ?>" alt="user"><?php echo $user['user_nick']; ?></a>
	</div>

	<!--用户信息-->
	<div id="user" class="modal">
		<div class="user_modal_content animate">
			<div class="user_modal_img">
				<span onclick="document.getElementById('user').style.display='none'" class="close">&times;</span>
				<div id="showImg"><img src="<?php echo '../..'.$user['pic_path']; ?>" alt=""></div>
			</div>

			<form class="user_modal_form" action="../admin/update_user_data.php" method="post" enctype="multipart/form-data">
				<span>上传头像：<input id="up_img" type="file" name="pic_path" accept="image/*" onchange="fileUpLoad(this);"></span>
				<p>账&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;号：<?php echo $user['user_account'];?></p>
				<p>用&nbsp;&nbsp;户&nbsp;名：<input type="text" name="user_nick" value="<?php echo $user['user_nick']; ?>"></p>

				<p>性&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;别：
					<?php if(empty($user['gender'])){ ?>
					   <input name="gender" type="radio" value="男">男
					   <input name="gender" type="radio" value="女">女
					<?php }else{
						echo $user['gender'];
					}?>
				</p>

				<p>联系方式：<input type="text" name="tel" value="<?php echo $user['tel']; ?>"><p>
<?php if($_SESSION['permission_id']==1 || $_SESSION['permission_id']==0){ ?>
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

			<a href="../admin/logout.php"><button>退出登录</button></a>
	</div>		
		</div>
	<div class="clearfix"></div>