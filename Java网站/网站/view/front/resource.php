<?php 
session_start();
require('../../lib/init.php');

//查询该学生的老师
if($_SESSION['permission_id']==3){
	$sql = "select teacher.user_account from user_data inner join teacher on user_data.class=teacher.t_class where user_data.user_account='$_SESSION[user_account]'";
	$teacher = mGetOne($sql);
}else if($_SESSION['permission_id']==0 || $_SESSION['permission_id']==1){
	$teacher = $_SESSION['user_account'];
}

//查询所有资源标签
$sql2 = "select tag_id,tag_name from resource_tag where user_account='$teacher'";
$tag_name = mGetAll($sql2);

/**
 * 实现分页功能 
 */

//查询资源总数
$sql3 = "select count(*) from resource";
$resource_sum = mGetOne($sql3);



//设置每页显示资源数量
$per_page_num = 12;

//从地址栏获得当前页码
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

//判断地址栏是否有tag_id,并调用分页函数
if(isset($_GET['tag_id'])){
	//查询单个标签的资源总数
	$sql4 = "select count(*) from resource where tag_id=$_GET[tag_id]";
	$tag_resource_sum = mGetOne($sql4);
	$where = " and tag_id=$_GET[tag_id] order by resource_id desc";
	$pages = getPage($tag_resource_sum,$current_page,$per_page_num);
	
	//查询这个tag_id的tag_name
	$sql5 = "select tag_name from resource_tag where tag_id=$_GET[tag_id]";
	$position = mGetOne($sql5);
}else{
	$where = ' order by resource_id desc';
	$pages = getPage($resource_sum,$current_page,$per_page_num);
}

//查询所有资源
$sql6 = "select resource_id,resource_name,resource_type,resource_path from resource where user_account='$teacher'" . $where . ' limit ' . ($current_page-1)*$per_page_num . ',' . $per_page_num;
$resource = mGetAll($sql6);

//输出下载量前8个资源
$sql7 = "select resource_id,resource_name,resource_type,resource_path from resource order by click_count desc limit 0,6";
$resource_recom = mGetAll($sql7);

//文件格式对应其图标
$map = array(
	'doc'=>'../../images/icon/doc.png',
	'docx'=>'../../images/icon/doc.png',
	'ppt'=>'../../images/icon/ppt.png',
	'pptx'=>'../../images/icon/ppt.png',
	'zip'=>'../../images/icon/zip.png',
	'rar'=>'../../images/icon/rar.png',
	'exe'=>'../../images/icon/exe.png',
	'jar'=>'../../images/icon/jar.png'
);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../../css/public.css">
	<script src="../../js/jquery.js"></script>
	<title>课程资源</title>
</head>
<body>
	<?php include('./nav.php'); ?>
	<!--课程资源-->
	<div class="resource_container">
	<!--资源下载-->
		<div class="resource_container_left">
			<div class="resource_show">			
			<span>当前位置:<a href="./resource.php">JAVA课程资源</a>&gt;<span>
				<?php 
					if(isset($_GET['tag_id'])){
						echo $position;
					}else{
						echo '全部资源';
					}
				 ?> 
			</span>
			</span>
	<!-- 输出全部资源 -->
		<?php foreach($resource as $v){ ?>
			<figure class="one_resource" data-rid="<?php echo $v['resource_id'];?>">
				<a href="<?php echo '../..',$v['resource_path']; ?>" download="<?php echo $v['resource_name'],'.',$v['resource_type']; ?>">
				<img src="<?php echo $map[$v['resource_type']]; ?>" alt="pic" data-rid="<?php echo $v['resource_id']; ?>">
				<figcaption data-rid="<?php echo $v['resource_id']; ?>">
					<?php echo $v['resource_name']; ?>
				</figcaption>	
				</a>
			</figure>
		<?php } ?>
	</div>
	<!-- 分页页号 -->
		<div id="page_bar" style="top:30px;">
			<?php 
				foreach($pages as $k=>$v){
					if($k == $current_page){
						echo '<span>',$k,'</span>';
					}else{
						echo '<a href="./resource.php?',$v,'">',$k,'</a>';
					}
				}
			?>
		</div>

		</div>
	<!--资源分类-->
		<div class="resource_select">
		<?php if($_SESSION['permission_id']==0 || $_SESSION['permission_id']==1){ ?>
			<button id="up_res_btn" type="button">+发布资源</button>
			<button id="add_tag_btn" type="button">+添加分类</button>
		<?php } ?>
			<div class="resource_category">
				<p><img style="width: 20px;" src="../../images/icon/about.png" alt="">资源分类</p>
				<ul>
			<!-- 输出资源标签名 -->
		<?php foreach($tag_name as $v){ ?>
					<li><a href="./resource.php?tag_id=<?php echo $v['tag_id']; ?>"><?php echo $v['tag_name']; ?></a></li>
		<?php } ?>
				</ul>
			</div>
			<div class="clearfix"></div>

	<!--资源推荐-->
			<div class="resource_recom">
				<p><img style="width: 20px;" src="../../images/icon/about.png" alt="">推荐资源</p>
				<ul>
				<?php foreach($resource_recom as $v){
					echo '<li><a class="one_resource" href="','../..',$v['resource_path'],'" download="',$v['resource_name'],'.',$v['resource_type'],'" data-rid="',$v['resource_id'],'">',$v['resource_name'],'</a></li>';
				} ?>
				</ul>
			</div>
		</div>
	</div>
	<div class="clearfix"></div>
	<!--上传资源-模态框-->
	<div id="upload_resource" class="modal">
		<div class="upload_modal_content animate">
			<h1><img src="../../images/icon/work.png" alt="">上传课程资源</h1>
			<span id="up_res_close" class="close">&times;</span>
		<form id="upload_resource_form"  method="post" enctype="multipart/form-data">
			<p>资源名字:<input type="text" name="resource_name" required="required"></p>
			<p>资源分类:
				<select name="tag_name">
		<?php foreach($tag_name as $v){ ?>
				<option value="<?php echo $v['tag_name']; ?>"><?php echo $v['tag_name']; ?></option>
		<?php } ?>
				</select>
			</p>
			<p>文件上传:<input name="resource" type="file"></p>
			<p><input type="submit" value="上传"></p>
		</form>
		<!-- 进度条 -->
		<div class="upload_progress">
			<div id="upload_progress"></div>
		</div>
		<h2 id="upload_rate"></h2>
		<div class="clearfix"></div>
		</div>
	</div>

<!--添加标签-模态框-->
	<div id="add_tag" class="modal">
		<div class="add_tag_content animate">
			<h1><img src="../../images/icon/work.png" alt="">添加资源分类<span>(最多可添加5个)</span></h1>
			<span id="add_tag_close" class="close">&times;</span>
		<form method="post">
			<input type="text" name="tag_name" placeholder="请输入资源类名" required="required">
			<input type="submit" value="添加">
		</form>
		</div>
	</div>
	<?php include('./foot.html'); ?>
</body>
<script type="text/javascript" src="../../js/resource.js"></script>
<script>
//ajax统计下载次数
$(".one_resource").bind('click',function(event){
  $.get('../admin/count_download.php?resource_id='+event.target.getAttribute("data-rid"),function(data){
  });
});
</script>
</html>