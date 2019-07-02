<?php
namespace Home\Controller;
use Think\Controller;
class CatController extends Controller {
    public function cat(){
    	//查询栏目
		$tree = D('Admin/Cat')->getTree();
		$this->assign('tree',$tree);

        if(isset($_GET['cat_id'])){
            //查询栏目商品
            $cat_id = I('get.cat_id');

            //面包屑
            $mbx = new \Home\Controller\GoodsController();
            $this->assign('mbx',$mbx->mbx(I('get.cat_id')));

            //输出商品总数
            $count = D('Goods')->where("cat_id=$cat_id")->cache(true)->count();
            $this->assign('count',$count);

            $Page = new \Think\Page($count,12);
            $show = $Page->show();
            $cats = D('Goods')->field('goods_id,goods_name,shop_price,goods_img,market_price')->where("cat_id=$cat_id")->limit($Page->firstRow.','.$Page->listRows)->select();
            $this->assign('page',$show);
            $this->assign('cat_goods',$cats);
        }else if($_GET['keywords']){
            $keywords = I('get.keywords');
            $map['goods_name'] = array('like',"%$keywords%");
            $count = D('Goods')->where($map)->cache(true)->count();

            $Page = new \Think\Page($count,12);
            $show = $Page->show();
            $s_res = D('Goods')->field('goods_id,goods_name,shop_price,goods_img,market_price')->where($map)->limit($Page->firstRow.','.$Page->listRows)->cache(true)->select();

            $this->assign('page',$show);
            $this->assign('cat_goods',$s_res);
            $this->assign('count',$count);
            $this->assign('mbx','搜索'.'"'.$keywords.'"');
        } 
        //历史浏览
        $this->assign('his',array_reverse(session('history')));
        $this->display();

    }
}