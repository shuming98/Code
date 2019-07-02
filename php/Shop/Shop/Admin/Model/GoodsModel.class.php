<?php 
namespace Admin\Model;
use Think\Model\RelationModel;

class GoodsModel extends RelationModel{
	public $_link = array(
		'comment' => self::HAS_MANY
	);

	//自动验证表单数据
	protected $_validate = array(
		array('goods_name','3,16','必须是3-16个字母或数字',1,'length',3),
		array('goods_sn','','商品已存在,请重新填写',1,'unique',3)
	);

	//自动填充数据库字段
	protected $_auto = array(
		array('add_time','time',1,'function'),
		array('last_update','time',2,'function')
	);

	//自动过滤不允许添加的数据(设置允许插入表的数据)
	protected $insertFields = 'goods_sn,cat_id,goods_name,goods_number,
goods_weight,shop_price,goods_desc,
goods_brief,ori_img,goods_img,thumb_img,is_best,
is_new,is_hot,is_sale,add_time';
}
