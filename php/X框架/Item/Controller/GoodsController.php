<?php
class GoodsController extends Controller{
	public function show(){
		echo '显示商品信息';
		$this->assign('title','天气');
		$this->assign('intro','晴朗');
		$this->display('index');

	}
}
?>