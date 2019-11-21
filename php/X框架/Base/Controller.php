<?php 
class Controller{
	
	/**
	 * 向模板传值
	 * @var  array data
	 */
	public $data = [];
	
	public function assign($tag,$value){
	 	$this->data[$tag] = $value;
	}


	/**
	 * 显示模板
	 */
	public function display($file){
		//解压，把键值解压成键=值
		extract($this->data);
		//打包，把键值打包成关联数组compact()
		include(APP_PATH . '/View/' . $file . '.html');
	}

}
 ?>
