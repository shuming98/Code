<?php
namespace Home\Controller;
use Think\Controller;
class GoodsController extends Controller {
    public function goods(){
    	$goods_info = D('Goods')->find(I('get.goods_id'));
        
        //历史浏览调取
        if($goods_info){
            $this->history($goods_info);
        }
        //关联模型
        $commentinfo = D('Goods')->relationGet('comment');

        $this->assign('comment',$commentinfo);

    	$this->assign('mbx',$this->mbx($goods_info['cat_id']));
    	$this->assign('goods',$goods_info);
        $this->display();
    }

    public function mbx($cat_id){
    	$row = D('Cat')->find($cat_id);
    	$tree[] = $row;
    	while($row['parent_id']>0){
    		$row = D('Cat')->find($row['parent_id']);
    		$tree[] = $row;
    	}
    	return array_reverse($tree);
    }

    public function history($info){
        $row = session('?history')?session('history'):array();
        //存储一部分信息
        $g = array();
        $g['goods_name'] = $info['goods_name'];
        $g['goods_price'] = $info['goods_price'];
        $g['goods_id'] = $info['goods_id'];
        $row[$info['goods_id']] = $g;
        //array(13=>array(.....))

        //限制数组大小
        if(count($row)>7){
            $key = key($row);
            unset($row[$key]);
        }
        
        //存入session
        session('history',$row);
    }

    public function comment(){
        if(IS_POST){
           $Model = D('Comment');
            $_POST['pubtime'] = time();
            if(!$Model->create()){
                echo $Model->getError();
                exit;
            }      
            if($Model->add()){
                $this->success('评论成功,感谢你的反馈','',2);
            }else{
               $this->error('评论失败,请稍后再试','',2);
            }
         }
    }
}