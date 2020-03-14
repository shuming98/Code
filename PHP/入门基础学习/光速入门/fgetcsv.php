<?php 
$fh=fopen('text.txt', 'r');
print_r(fgetcsv($fh));
 ?>