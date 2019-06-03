<?php 
$arr = array(
    1,2,3,4,5,6,7,8,9
);
for($i = 0; $i < 40; $i++) {
    $tmp[] = $arr[array_rand($arr)].mt_rand(1000,9999).mt_rand(1000,9999).'@qq.com';
}
var_export(array_unique($tmp));

?>