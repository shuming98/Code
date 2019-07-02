<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<h2>输出变量：<?php echo ($num); ?></h2>
	<hr>	
	<h2>if else 判断：	
		<?php if($num > 5): ?>你及格了
			<?php else: ?>
			没及格<?php endif; ?>
	</h2>
	<hr>
	<h2>三元运算符：<?php echo ($three); ?>是<?php echo ($three?'对了':'错了'); ?></h2>
	<hr>
	<h2>数组遍历：
		<?php if(is_array($array)): foreach($array as $k=>$v): echo ($k); ?>--<?php echo ($v); endforeach; endif; ?>
	</h2>	
</body>
</html>