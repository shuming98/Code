<?php  
/*print_r($_POST);*/
$str=$_POST['name'] . '    ' . $_POST['email'] . '   ' . $_POST['message'] . "\n";
$fh=fopen('./say.txt','a');
fwrite($fh,$str);
fclose($fh);
echo '<p style="font-size:16px;">我也不知道为什么异步失败<br/>只能用这种最简单的方式接受用户信息</p>';
echo '<p style="font-size:30px;">已留言成功，点击<a href="../index.html">这里</a>返回</p>';
?>