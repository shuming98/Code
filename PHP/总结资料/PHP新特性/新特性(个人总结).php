一、SQL注入
	①SQL注入例子：
	别人填写账号为：mysql'# (lily' or 1;#)密码随便，会让数据库查出数据并业务逻辑通过验证.
	select * from user from user='admin'#' and passwd='123456';
	(sql不会识别#后面的注释)

	②SQL注入的根本原因：命令和参数发生混淆。
	
	③解决：命令和参数分两步，使用SQL预处理语句(mysql命令行下)。
	
		prepare st from 'select * from user where uname=?';
		set @u='admin'
		execute st using @u;

二、PHP新特性
	①三目运算符：
		$a?$a:1 ---> $a ?: 1
		isset($a)?$a:1 ---> $a ?? 1
	②匿名函数&添加变量类型：
		$sum = function(int $a,int $b){}
	③数组形式：
		array(1,2,3,4) ---> [1,2,3,4]
	④数组直接调用某值：
		echo $arr[0];
		echo [1,2,3,4][1];
	⑤短标签
		<?php echo $a; ?> ---> <?=$a?>
	⑥trait特性
	⑦echo类名
		echo T::class;
	⑧数组赋值给list(),foreach支持list
	⑨函数传入函数拆包和解包
	⑩立方运算
		echo 2 ** 5;

