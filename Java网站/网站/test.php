<?php 
$old_url = $_SERVER["REQUEST_URI"]; 
//检查链接中是否存在 ? 
$check = strpos($old_url, '?'); 
//如果存在 ? 
if($check !== false) 
{ 
//如果 ? 后面没有参数，如 http://www.yitu.org/index.php? 
if(substr($old_url, $check+1) == '') 
{ 
//可以直接加上附加参数 
$new_url = $old_url; 
} 
else //如果有参数，如：http://www.yitu.org/index.php?ID=12 
{ 
$new_url = $old_url.'&'; 
} 
} 
else //如果不存在 ? 
{ 
$new_url = $old_url.'?'; 
} 
echo $new_url; 
?> 