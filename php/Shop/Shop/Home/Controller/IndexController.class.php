<?php
namespace Home\Controller;
use Think\Controller;
use Home\Tool\MingTool;
class IndexController extends Controller {
    public function index(){
		//热销
		$hot_goods = D('Goods')->field('goods_id,goods_name,shop_price,goods_img,market_price')->where('is_hot=1')->order('goods_id desc')->limit(4)->select();
		$this->assign('hots',$hot_goods);

		//精品
		$best_goods = D('Goods')->field('goods_id,goods_name,shop_price,goods_img,market_price')->where('is_best=1')->order('goods_id desc')->limit(4)->select();
		$this->assign('bests',$best_goods);

		//新品
		$new_goods = D('Goods')->field('goods_id,goods_name,shop_price,goods_img,market_price')->where('is_new=1')->order('goods_id desc')->limit(4)->select();
		$this->assign('news',$new_goods);

		//销售排行
		$row_goods = D('Goods')->field('goods_id,goods_name,shop_price')->order('goods_id asc')->limit(7)->select();
		$this->assign('row',$row_goods);

		//查询栏目
		$tree = D('Admin/Cat')->getTree();
		$this->assign('tree',$tree);
        $this->display();
    }

    public function xx(){
    	//new \Home\Tool\MingTool()->ha();
    	$ceshi = new MingTool();
    	echo $ceshi->ha();
    }
}