<?php  
/*print_r($_POST);*/
$str=$_POST['name'] . '    ' . $_POST['email'] . '   ' . $_POST['message'] . "\n";
$fh=fopen('./say.txt','a');
fwrite($fh,$str);
fclose($fh);
echo '<p style="font-size:30px;">已留言成功，点击<a href="./nglinux.html">这里</a>返回</p>';
?>