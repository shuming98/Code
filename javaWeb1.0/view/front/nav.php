<?php 
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
?>
	<div class="header_pic">
		<div>
			<img class="header_logo" src="../../images/icon/logo.png" alt="logo">
		</div>
	</div>
	<!--导航栏-->
<div class="nav_bg">
	<div class="nav">
		<ul>
			<li><a href="../../index.php"><img src="../../images/icon/home.png" alt="home">首页</a></li>
			<li><a href="./resource.php"><img src="../../images/icon/resource.png" alt="resource">课程资源</a></li>
			<li><a href="./study.php"><img src="../../images/icon/study.png" alt="study">学习园地</a></li>
			<?php if($_SESSION['permission_id']==1 || $_SESSION['permission_id']==2){ ?>
			<li><a href="./check_work.php"><img src="../../images/icon/work.png" alt="work">作业区</a></li>
			<?php }else{ ?>			
			<li><a href="./show_work.php"><img src="../../images/icon/work.png" alt="work">作业区</a></li>
			<?php } ?>
			<?php if($_SESSION['permission_id']==1 || $_SESSION['permission_id']==2){ ?>
			<li><a href="./t_test.php"><img src="../../images/icon/test.png" alt="about">发布试题</a></li>
			<?php }else{ ?>
			<li><a href="s_test.php"><img src="../../images/icon/test.png" alt="about">试题练习</a></li>
			<?php } ?>
			<li><a href="./forum.php"><img src="../../images/icon/forum.png" alt="forum">讨论区</a></li>
		</ul>
		<a class="user_message" href="#" onclick="document.getElementById('user').style.display='block'"><img src="<?php echo '../..'.$user['pic_path']; ?>" alt="user"><?php echo $user['user_nick']; ?></a>
	</div>
</div>

		<!--用户信息-->
	<div id="user" class="modal">
		<div class="user_modal_content animate">
			<div class="user_modal_img">
				<span onclick="document.getElementById('user').style.display = 'none'"  class="close">&times;</span>
				<div id="showImg"><label for="up_img"><img src="<?php echo '../..'.$user['pic_path']; ?>" alt="img"></label></div>
			</div>

			<form class="user_modal_form" action="../admin/update_user_data.php" method="post" enctype="multipart/form-data">
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
			<a class="cpasswd" href="../admin/cpasswd.php">修改密码</a>
				<input type="submit" value="修改信息">
			</form>
			<a href="../admin/logout.php"><button>退出登录</button></a>
	</div>		
		</div>
	<div class="clearfix"></div>