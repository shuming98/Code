<?php 
$data=$_POST['username'].','.$_POST['info']."\n";
$file=fopen('留言.txt','a');
fwrite($file,$data);
fclose($file);
echo '写入成功.';
?>