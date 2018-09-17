<?php
  session_start();
  $image = imagecreatetruecolor(100, 30);  
  $bgcolor = imagecolorallocate($image,255,255,255); 
  imagefill($image, 0, 0, $bgcolor);
  $captcha_code = "";
  for($i=0;$i<4;$i++){
    $fontsize = 100;    
    $fontcolor = imagecolorallocate($image, rand(0,120),rand(0,120), rand(0,120)); 
    $data ='abcdefghigkmnpqrstuvwxy3456789';
    $fontcontent = substr($data, rand(0,strlen($data)),1);
    $captcha_code .= $fontcontent;    
    $x = ($i*100/4)+rand(5,10);
    $y = rand(5,10);
    imagestring($image,$fontsize,$x,$y,$fontcontent,$fontcolor);
  }
  $_SESSION['authcode'] = $captcha_code;
  header('Content-Type: image/png');
  imagepng($image);
  imagedestroy($image);
  ?>