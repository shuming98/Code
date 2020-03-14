<?php 
$fh=fopen('text.txt', 'r');
$tid=$_GET['tid'];
$i=1;
while(($row=fgetcsv($fh))!=false){
	if($i == $tid){
//		print_r($row);
	echo '<h4 style="color:blue;">',print_r($row),'</h4>';
	}
	$i=$i+1;
}
/*选择输第几行： ？tid=number */

/*$fh=fopen('text.txt','r');
while(fgetcsv($fh)!=false)
{
	echo print_r(fgetcsv($fh)),'<br/>';  //不加循环，一条输出行
}
输出全部，直到为空
*/
?>
