<?php 
$arr = array(
    130,131,132,133,134,135,136,137,138,139,
    144,147,
    150,151,152,153,155,156,157,158,159,
    176,177,178,
    180,181,182,183,184,185,186,187,188,189,
);
for($i = 0; $i < 40; $i++) {
    $tmp[] = $arr[array_rand($arr)].mt_rand(1000,9999).mt_rand(1000,9999);
}
var_export(array_unique($tmp));

?>