<?php 
$path='/Users/shuming/www/';
$url=$_SERVER['REQUEST_URI'];   //读取当前路径

if(isset($_GET['dir'])){             //地址传参
	$path=$path . '/' . $_GET['dir'];
}else{
	$url=$url.'?dir=.';
}

$df=opendir($path);  //打开文件
$arr=array();	     //构造数组

if($df===false){     //判断文件是否存在
	echo '打开出错';
	exit;       
}

while(($file=readdir($df))!==false){    //读取文件信息
		$arr[]=$file;
}
closedir($df);	//关闭文件
error_reporting(0);
print_r($arr);
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>文件管理系统</title>
	<style type="text/css">
	table{
		border-collapse: collapse;
	}
	td{
		border:1px solid black;
	}
</style>
</head>
<body>
	<h1>文件管理</h1>
	<table>
		<tr>
			<td>序号</td>
			<td>文件名</td>	
			<td>操作</td>
		</tr>
		<?php foreach($arr as $key=>$value){ ?>
		<tr>
			<td><?php echo $key; ?></td>
			<td><?php echo $value; ?></td>
			<td>
				<?php 
				if(is_dir($path . './' . $value)){
					echo '<a href="',$url.'/',$value,'">浏览</a>';   //地址传参
				}else{
					echo '<a href="./',$_GET['dir'],'/',$value,'">查看</a>';
				}
				 ?>
				
			</td>
		</tr>
	<?php  }?>
	</table>
</body>
</html>