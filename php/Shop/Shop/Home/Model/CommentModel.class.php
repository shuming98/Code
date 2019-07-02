<?php 
namespace Home\Model;
use Think\Model\RelationModel;
class CommentModel extends RelationModel{
	public $_validate = array(
		array('content','6,140','评论长度至少6-140个文字',1,'length',3)
	);
}
 ?>
