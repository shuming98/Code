<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="/css/app.css">
</head>
<body class="container">
	<table class="table">
		<h1>数据输出打印</h1>
		<thead>
			<tr>
				<th>序号</th>
				<th>标题</th>
				<th>内容</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($msg as $v){ ?>
			<tr> 
				<td><?php echo $v->id; ?></td>
				<td><?php echo $v->title; ?></td
					>
				<td><?php echo $v->content; ?></td>
				<td>
					<a href="/msg/edit/<?php echo $v->id; ?>">编辑</a>
					<a href="/msg/del/<?php echo $v->id; ?>">删除</a>
				</td>
			</tr>
		<?php } ?>
		</tbody>
	</table>
</body>
</html>