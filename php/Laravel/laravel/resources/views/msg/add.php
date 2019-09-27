<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="/css/app.css">
</head>
<body class="continer">
	<h1>添加</h1>
	<form action="" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label>标题</label><input class="form-control" type="text" name="title">
		</div>
		<div class="form-group">
			<label>内容</label><input class="form-control" type="text" name="content">
		</div>
		<div class="form-group">
			<label for="">文件上传</label>
			<input type="file" class="form-control" name="pic" id="">
		</div>
		<input type="hidden" name="_token" value="<?php echo csrf_token();?>">
		<input type="submit" value="提交" class="button">
	</form>
</body>
</html>