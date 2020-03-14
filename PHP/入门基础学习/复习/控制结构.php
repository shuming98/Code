<?php
/*$a=2; 
switch ($a) {
	case '1':
	echo '你';
		break;
	case '2':echo '我';break;
	case '3':echo '他';break;

	default:
		echo '他们';
		break;
}*/

/*$a=1;$i=1;
while ($i <= 10) {
	$a=$i*$a;
	$i++;
echo $a.'<br/>';
}*/

/*$a=1;$i=1;
do{
	$a=$a+$i;
	$i++;
	echo $a.'<br/>';
}while($i<0)*/
/*
for($i=100000,$num=0;$i>=5000;){
	$i>=50000?$i*=0.95:$i-=5000;
	$num++;
}
echo '共过桥'.$num.'次','还剩下'.$i.'钱。';
*/

/*for($x=1;$x<=9;$x++){
	echo '<br/>';
	for($y=1;$y<=$x;$y++){
	echo $y,'*',$x,'=',$y*$x,'&nbsp';	
	}
}
*/
for($g=1;$g<20;$g++){
	for($m=1;$m<33;$m++){
		for($x=1;$x<100;$x++){
			if(($g+$m+$x==100)&&($g*5+$m*3+$x/3==100)){
				echo '共购买公鸡',$g,'母鸡',$m,'小鸡',$x,'<br/>';
			}

		}

	}
}

?>

