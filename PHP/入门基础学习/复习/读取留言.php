<?php 
$tid=$_GET['tid'];
$file=fopen('./留言.txt','r');
//读取一条留言 print_r($file);
//读取全部留言
while(($row=fgetcsv($file))!=false){
	print_r($row);
	echo "<br/>";
}
//只读取留言一部分:print_r($row[0])
//挑选读取那一条留言
/*$i=1;
while(($row=fgetcsv($file))!=false){
	if($i==$tid){
		print_r($row);
	}
	$i++;
}*/
?>
