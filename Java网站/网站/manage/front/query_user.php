<?php 
session_start();
require('../../lib/init.php');

//查询所有班级
$sql = "select t_class from teacher group by t_class";
$class = mGetAll($sql);

/**
 * 实现分页功能
 */

//从地址栏获得当前页码
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

//设置每页显示数据数
$per_page_num = 14;

//权限查询
if(isset($_GET['permission'])){
	$sql2 = "select user_data.user_account,user_nick,gender,tel,class from user_data inner join user on user_data.user_account=user.user_account where user.permission_id=$_GET[permission] order by user.user_id asc" . ' limit ' . ($current_page-1)*$per_page_num . ',' . $per_page_num;
	$res = mGetAll($sql2);

	$sql3 = "select count(*) from user where permission_id=$_GET[permission]";
	$num = mGetOne($sql3);
}

//班级查询
if(isset($_GET['class'])){
	$sql4 = "select user_data.user_account,user_nick,gender,tel,class from user_data inner join user on user_data.user_account=user.user_account where class='$_GET[class]' order by user.user_id asc" . ' limit ' . ($current_page-1)*$per_page_num . ',' . $per_page_num;
	$res = mGetAll($sql4);

	$sql5 = "select count(*) from user_data where class='$_GET[class]'";
	$num = mGetOne($sql5);
}

//账号查询
if(isset($_GET['account'])){
	$sql6 = "select user_account,user_nick,gender,tel,class from user_data where user_account='$_GET[account]'";	
	$res = mGetAll($sql6);

	$sql7 = "select count(*) from user_data where user_account='$_GET[account]'";
	$num = mGetOne($sql7);
}

$pages = getPage($num,$current_page,$per_page_num);

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../../css/manage.css">
	<script src="../../js/jquery.js"></script>
	<title>后台管理</title>
</head>
<body>
	<?php include('./header.php'); ?>
	<div class="manage_container">
		<?php include('./sidenav.html'); ?>
		<div class="function">
			<div class="user_query_container">
				<h2>用户信息查询</h2>
				<span class="h2_line"></span>
			<div>	
				<span class="query_acc">权限:</span>
				<form action="" method="get" accept-charset="utf-8">
					<select name="permission">
						<option value="0">管理员</option>
						<option value="1">教师</option>
						<option value="3">学生</option>
					</select>
					<input type="submit" value="查询">
				</form>
				<span class="query_acc">班级:</span>
				<form action="" method="get" accept-charset="utf-8">
					<select name="class">
						<?php foreach($class as $v){
							echo '<option value="',$v['t_class'],'">',$v['t_class'],'</option>';
						}?>
					</select>
					<input type="submit" value="查询">
				</form>
				<span class="query_acc">账号:</span>
				<form action="" method="get" accept-charset="utf-8">
					<input type="text" name="account" placeholder="请输入用户账号">
					<input type="submit" value="查询">
				</form>
			</div>
			<div class="clearfix"></div>
			<div class="query_result_container">
				<table class="query_result_table">
					<tr>
						<th>账号</th>
						<th>昵称</th>
						<th>性别</th>
						<th>联系方式</th>
						<th>班级</th>
						<th colspan="2">数据操作</th>
					</tr>
					<?php foreach($res as $v){ ?>
					<tr>
						<td><?php echo $v['user_account']; ?></td>
						<td><?php echo $v['user_nick']; ?></td>
						<td><?php echo $v['gender']; ?></td>
						<td><?php echo $v['tel']; ?></td>
						<td><?php echo $v['class']; ?></td>
					<?php //唯学生有修改
					$sql9 = "select permission_id from user where user_account='$v[user_account]'";
					if(mGetOne($sql9) == 3){
						echo '<td><a class="res_modify" data-opclass="',$v[user_account],'">修改</a></td>';
					}
						?>
						<td><a class="res_remove" data-account="<?php echo $v['user_account']; ?>">删除</a></td>	
					</tr>
					<?php } ?>
				</table>
				<?php echo '<span class="query_num">*&nbsp;一共查询到 ',$num,' 条数据</span>';?>
			</div>
			<!--添加标签-模态框-->
			<div id="modify_userdata" class="modal">
				<div class="modify_userdata_content animate">
					<h1><img src="../../images/icon/work.png" alt="">更正学生班级</h1>
					<span id="modify_userdata_close" class="close">&times;</span>
					<form id="modify_classdata_form" method="post">
						<span>班级：</span><select name="class">
						<?php foreach($class as $v){
							echo '<option value="',$v['t_class'],'">',$v['t_class'],'</option>';
						} ?>
						</select>
						<input type="submit" value="更改">
					</form>
				</div>
			</div>
			<!--分页页号-->
			<div id="page_bar" style="top:0px;">
				<?php 
					foreach($pages as $k=>$v){
						if($k == $current_page){
							echo '<span>',$k,'</span>';
						}else{
							echo '<a href="./query_user.php?',$v,'">',$k,'</a>';
						}
					}
				?>
			</div>
			</div>
		</div>
	</div>
	<?php include('./footer.html'); ?>
</body>
<script>
//ajax删除数据
$(".res_remove").click(function(){
	$.get('../admin/delete_data.php?account='+$(this).data('account'),function(res){
		alert(res);
		location.reload();
	});
});

//打开修改班级-模态框&&提交数据
$(".res_modify").click(function(event){
	var that =this;
	$("#modify_userdata").css("display","block");
	$("#modify_classdata_form").submit(function(){
		$.post('../admin/modify_data.php?opclass='+$(that).data('opclass'),$("#modify_classdata_form").serialize(),function(res){
			alert(res);
			location.reload();
		});
	});
	return false;
});

//关闭修改班级-模态框
$("#modify_userdata_close").click(function(){
	$("#modify_userdata").css("display","none");
});
</script>
</html>