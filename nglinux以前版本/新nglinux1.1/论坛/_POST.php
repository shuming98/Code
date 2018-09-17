<?php  
/*print_r($_POST);*/
$str=$_POST['textarea'] . "\n";
$fh=fopen('./forum.txt','a');
fwrite($fh,$str);
fclose($fh);
?>