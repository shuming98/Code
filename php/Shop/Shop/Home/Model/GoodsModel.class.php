<?php 
namespace Home\Model;
use Think\Model\RelationModel;
class GoodsModel extends RelationModel{
	public $_link = array(
		'comment' => self::HAS_MANY
	);
}
?>