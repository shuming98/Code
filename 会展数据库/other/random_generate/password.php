<?php 
function generate_password( $length = 8 ) {
 $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@^*-_~`+=';
 $password = '';
 for ( $i = 0; $i < $length; $i++ ) 
 {
  $password .= $chars[ mt_rand(0, strlen($chars) - 1) ];
 }
 return $password;
}
echo generate_password(8),'<br/>';
?>