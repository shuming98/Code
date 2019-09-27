<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="/css/app.css">
</head>
<body class="continer">
	<h1>编辑</h1>
	<form action="" method="post">
		<div class="form-group">
			<label>标题</label><input class="form-control" type="text" name="title" value="<?php echo $msg->title; ?>">
		</div>
		<div class="form-group">
			<label>内容</label><input class="form-control" type="text" name="content" value="<?php echo $msg->content; ?>">
		</div>
		<input type="hidden" name="_token" value="<?php echo csrf_token();?>">
		<input type="submit" value="提交" class="button">
	</form>
</body>
</html>