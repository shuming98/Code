<?php
namespace Admin\Controller;
use Think\Controller;
class GoodsController extends Controller {
	public function goodsAdd(){
		if(!IS_POST){
			$tree = D('Admin/Cat')->getTree();
			$this->assign('tree',$tree);
			$this->display();
		}else{ 
			$goodsmodel = D('Goods');

			//文件上传
			$upload = new \Think\Upload();
			$upload->exts = array('jpg','gif','png','rar','zip');
			$upload->rootPath = './Public/up/';
			$info = $upload->upload();
			if($info){
				$_POST['goods_img'] = '/Public/up/'.$info['goods_img']['savepath'].$info['goods_img']['savename'];
				//图片缩略
				// $img = new \Think\Image();
				// $path = './Public/up/'.$info['goods_img']['savepath'].$info['goods_img']['savename'];
				// $img->open($path);
				// $thumb_path = '/Public/up/thumb/'.$info['goods_img']['savename']; 
				// $thumb_path1 = './Public/up/thumb/'.$info['goods_img']['savename']; 
				// $img->thumb(150,150)->save($thumb_path1);
				// $_POST['thumb_img'] = $thumb_path;
			}else{
				var_dump($upload->getError());
			}

			if(!$goodsmodel->create()){
				echo $goodsmodel->getError();
			}else{
				$goodsmodel->add()?$this->success('添加商品成功','goodslist',3):$this->error('添加商品失败');
			}
		}
	}

	public function goodslist(){
		$model = D('Goods');
		$tree = D('Admin/Cat')->getTree();

		if(isset($_GET['cat_id'])){
			$cat_id = I('get.cat_id');
			$keyword = I('get.keyword');
			$intro_type = I('get.intro_type')!=0?I('get.intro_type'):1;
			$map = "cat_id=$cat_id and $intro_type=1 and goods_name like '%$keyword%'";

			$count = $model->where($map)->count();
			
			//分页功能
			$Page = new \Think\Page($count,10);
			$show = $Page->show();
			$goods = $model->field('goods_id,goods_name,goods_sn,shop_price,is_on_sale,is_best,is_new,is_hot,goods_number')->where($map)->order('goods_id asc')->limit($Page->firstRow.','.$Page->listRows)->select();
		}else if(!isset($_GET['cat_id'])){
			//分页功能
			$count = $model->count();
			$Page = new \Think\Page($count,10);
			$show = $Page->show();
			$goods = $model->field('goods_id,goods_name,goods_sn,shop_price,is_on_sale,is_best,is_new,is_hot,goods_number')->order('goods_id asc')->limit($Page->firstRow.','.$Page->listRows)->select();
			}

			$this->assign('count',$count);
			$this->assign('page',$show);
			$this->assign('goods',$goods);
			$this->assign('tree',$tree);
			$this->display();
	}

    public function goodsedit(){
	    $model = D('Goods');
	    if(!IS_POST){
	        $good_id = I('get.goods_id');
	        $goodinfo = $model->find($good_id);
	        $tree = D('Admin/Cat')->getTree();
			$this->assign('tree',$tree);
	        $this->assign('info',$goodinfo);
	        $this->display();
	    }else{
	    	//文件上传
			$upload = new \Think\Upload();
			$upload->exts = array('jpg','gif','png','rar','zip');
			$upload->rootPath = './Public/up/';
			$info = $upload->upload();
			if($info){
				$_POST['goods_img'] = '/Public/up/'.$info['goods_img']['savepath'].$info['goods_img']['savename'];

				//图片缩略
				// $img = new \Think\Image();
				// $path = './Public/up/'.$info['goods_img']['savepath'].$info['goods_img']['savename'];
				// $img->open($path);
				// $thumb_path = '/Public/up/thumb/'.$info['goods_img']['savename']; 
				// $thumb_path1 = './Public/up/thumb/'.$info['goods_img']['savename']; 
				// $img->thumb(150,150)->save($thumb_path1);
				// $_POST['thumb_img'] = $thumb_path;
	    	}else{
	    			var_dump($upload->getError());
	    		}
	    	if(!$model->create()){
	    			echo $model->getError();
	    	}else{
	    			$model->where('goods_id='.$_POST['goods_id'])->save($_POST)?$this->success('修改成功','goodslist',3):$this->error('修改失败,请稍后再试');
	    		}
			}    	
	}	

	public function goodsdel(){
		$model = D('Goods');
		$res = $model->delete(I('get.goods_id'));
		if($res){
			$this->success('删除成功',U('Admin/Goods/goodslist'),3);
		}else{
			$this->error('删除失败');
		}
	}
}