<?php 
namespace Home\Controller;
use Think\Controller;
class FlowController extends Controller {
	public function add(){
		$goodsinfo = D('Goods')->find(I('get.goods_id'));
		$car = \Home\Tool\CarTool::getIns();
		if($goodsinfo){
			$car->add($goodsinfo['goods_id'],$goodsinfo['goods_name'],$goodsinfo['shop_price']);
		}

		$this->assign('car',$car->items());
		$this->assign('money',$car->calcMoney());
		$this->display('checkout');
	}

	//订单入库
	public function done(){
		$oi = M('ordinfo');
		$car = \Home\Tool\CarTool::getIns();

		$_POST['ord_sn'] = $ord_sn = date('Ymd').rand(1000,9999);
		$_POST['user_id'] = $_COOKIE['user_id']?$_COOKIE['user_id']:0;
		$_POST['money'] = $car->calcMoney();
		$_POST['ordtime'] = time();

		if($oi->create() && $ordinfo = $oi->add()){
		//增加成功后返回id
			$og = M('ordgoods');
			foreach($car->items() as $k=>$v){
				//array(13=>array(goods_name,shop_price)
				$row['goods_id'] = $k;
				$row['goods_name'] = $v['goods_name'];
				$row['shop_price'] = $v['shop_price'];
				$row['goods_num'] = $v['num'];
				$row['ordinfo_id'] = $ordinfo;
				$data[] = $row;//二维数据批量添加
			}
			if($og->addAll($data)){
				$this->assign('ord_sn',$ord_sn);
				$this->assign('money',$car->calcMoney());
			}
			$car->clear();	
		}
		$this->display();
	}

	public function pay(){
		$row = array();
		$row['v_amount'] = 0.01;
		$row['v_moneytype'] = 'CNY';
		$row['v_oid'] = date('Ymd').mt_rand(1000,99999);
		$row['v_mid'] = '1009001';
		$row['v_url'] = 'http://www.shop.com/index.php/Home/Flow/pay_ok';
		$row['key'] = '#(%#WU)(UFGDKJGNDFG';
		$row['v_md5info'] = strtoupper(md5($row['v_amount'].$row['v_moneytype'].$row['v_oid'].$row['v_mid'].$row['v_url'].$row['key']));
		$this->assign('pay',$row);
		$this->display();

	}
}
 ?>