<?php 
$fh=fopen('text.txt', 'r');
$tid=$_GET['tid'];
$i=1;
while(($row=fgetcsv($fh))!=false){
	if($i==$tid){
		print_r($row);
	}
	$i=$i+1;
}
?>
