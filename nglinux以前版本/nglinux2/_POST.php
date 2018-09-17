<?php  
/*print_r($_POST);*/
$str=$_POST['textarea'] . "\n";
$fh=fopen('./say.txt','a');
fwrite($fh,$str);
fclose($fh);
echo '<p style="font-size:30px;">已留言成功，点击<a href="./论坛.html">这里</a>返回</p>';
?>