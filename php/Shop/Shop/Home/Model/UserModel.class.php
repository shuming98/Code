<?php 
namespace Home\Model;
use Think\Model;
class UserModel extends Model{
	public $_validate = array(
		array('username','8,16','用户名长度必须8-16位',1,'length',3),
		array('email','email','邮箱不合法',1,'regex',3),
		array('password','6,16','密码长度必须6-16位',1,'length',3),
		array('re_password','password','两次密码不一致',1,'confirm',3)
	);
}
 ?>
