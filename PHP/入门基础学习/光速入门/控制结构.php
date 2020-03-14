<?php 
/*$chaomao=1;
while ($chaomao <= 10) {
	echo '你已经成功打了超懋',$chaomao,'拳','<br/>';
	$chaomao++;
}

echo '你共了打了超懋',$chaomao,'拳，并重伤了他';

$i = 1;
while($i<=99){
	if($i%15==0){
		echo 'abcde','<br/>';
	}
	else if($i%5==0){
		echo 'Buzz','<br/>';
	}
	else if($i%3==0){
		echo 'Fizz','<br/>';
	}
	else{
		echo $i,'<br/>';
	}
	$i++;
}

$i=2;	
switch ($i) {
	case '1':
		echo '1a';
		break;
	case '2':
		echo '2b';
		break;
	case '3':
		echo '3c';
		break;
	default:
		echo 'qq';
		break;
}*/

$a=0;
for($i=0;$i<10000;$i++){
	if($i%23==0){
		$a++;
	}
}
echo $a;
?>