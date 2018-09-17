<?php  
/*print_r($_POST);*/
$str=$_POST['id'] . $_POST['textarea'] . "\n";
$fh=fopen('./text.txt','a');
fwrite($fh,$str);
fclose($fh);
echo '已成功写入';
?>
