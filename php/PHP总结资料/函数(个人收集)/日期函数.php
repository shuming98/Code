<?php 
/**
 * 输入一个年份和月份，求当月多少天
 * @param  $year int 年份
 * @param  $month int 月份
 * @return  int 当月天数
 */
function my_days($year,$month){
	$days = [31,28,31,30,31,30,31,31,30,31,30,31];
	if((($year%4 == 0 && $year%100 !=0) || $year%400 == 0) && $month == 2){
		return 29;
	}else{
		return $days[$month-1];
	}
}

echo my_days(896,02);

function my_days_2($year,$month){
	if(checkdate($month,1,$year)){
	    if($month>=1 && $month<12){
	        $times = mktime(0,0,0,$month+1,1,$year) - mktime(0,0,0,$month,1,$year);
	    }elseif($month = 12){
	        $times = mktime(0,0,0,1,1,$year+1) - mktime(0,0,0,12,1,$year);
	    }
	    return $times / (3600*24);
	}
}


 ?>