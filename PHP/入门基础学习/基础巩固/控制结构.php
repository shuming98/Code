<?php 
/*
一、switch选择结构，用于验证多个可能值
switch(变量){
	case 1:执行;break;
	case 2:执行;break;
	case 3:执行;break;
	 ...
	 ...
	 ...
	 default：执行;
}

二、while循环结构
$i=1;
while (条件) {
	执行;
}

do{
	执行;                 先执行一次，再判断条件
}while(条件)

三、for简洁循环结构
for (初始化;条件;修改变量) {    与while无本质区别，形式更加简洁
	执行;                      嵌套的for,形式上来说就是，时钟上：秒分时针的关系
}
*/
/*
echo '过桥问题：','<br/>';
for($i=100000,$num=0;$i>=5000;){
	if($i>=50000){
		$i*=0.95;
	}else{
		$i-=5000;
	}
	$num+=1;
	echo '共过桥',$num,'次','还剩下',$i,'块','<br/>';
}*/

/*echo '九九乘法表：';
for($i=1;$i<=9;$i++){
	echo '<br />';
	for($j=1;$j<=$i;$j++){
		echo $j,'*',$i,'=',$j*$i,'&nbsp';

	}

}*/

/*echo '<h3>','百钱买百鸡:','</h3>','<br />';
for($g=1;$g<20;$g++){
	for($m=1;$m<33;$m++){
		for($x=1;$x<100;$x++){
			if(($g+$m+$x==100)&&($g*5+$m*3+$x/3==100)){
				echo '共买公鸡',$g,'只，','共买母鸡',$m,'只，','共买小鸡',$x,'只。','<br/>'	;
			}
		}
	}
}*/
 ?>
