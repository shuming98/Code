<?php 
function cookie_check(){
	if(md5(cookie('username').C('DB_SALT')) === cookie('ccode')){
		return 1;
	}else{
		return 0;
	}
}
 ?>
