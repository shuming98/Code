<?php
namespace Admin\Controller;
use Think\Controller;
class CatController extends Controller {
    public function cateAdd(){
    	if(!IS_POST){
            $catname = D('Cat')->where("parent_id=0")->select();
            $this->assign('catname',$catname);
            $this->display();
            exit();
        }else{
            $catModel = D('Cat');
            if($catModel->add($_POST)){
                $this->success('添加成功','catelist',3);
            }else{
                $this->error('添加失败','',3);
            }
        } 
    }

    public function catelist(){
        $catmodel = D('Cat');
        $cat = S('catlist');
        if($cat == false){
            $catlist = $catmodel->getTree();//无缓存从库中取
            S('catlist',$catlist,5);
        }else{
            $catlist = $cat;
        }
        $this->assign('count',$catmodel->count());
        $this->assign('list',$catlist);
        $this->display();
    }

    public function catedit(){
        $catmodel = D('Cat');
        if(!IS_POST){
            $cat_id = I('cat_id');
            $catinfo = $catmodel->find($cat_id);
            $catname = D('Cat')->where("parent_id=0")->select();
            $this->assign('info',$catinfo);
            $this->assign('catname',$catname);
            $this->display();
        }else{
            $res = $catmodel->where('cat_id='.$_POST['cat_id'])->save($_POST);
            if($res){
                $this->success('修改成功','catelist',3);
            }else{
                $this->error('修改失败,请稍后重试');
            }
        } 
    }

    public function catedel(){
        $catmodel = D('Cat');
        $catmodel->delete(I('get.cat_id'));
        $this->success('删除成功','',3);
    }
}