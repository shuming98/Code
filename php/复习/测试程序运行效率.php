<?php
$start=microtime(true);
for($i=0;$i<100000000;$i++){
	echo $i,' ';
}
$end=microtime(true);
echo '<br />';
echo $end-$start;
?>