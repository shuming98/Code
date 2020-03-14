<?php 
class Mini{
	public $data = array();

	//替换前端文件中变量符，并生成php文件
	public function comp($file){
		$html = file_get_contents($file);
		$html = str_replace('{$','<?php echo $this->data[\'',$html);
		$html = str_replace('}','\']; ?>',$html);
		$com = $file . '.php';
		file_put_contents($com, $html);
		return $com;
	}

	//输入变量名和值
	public function assign($k,$v){
		$this->data[$k] = $v;

	}

	//引入文件
	public function display($file){
		include($this->comp($file));
	}
}
//调用
$mini = new Mini();

//输出变量
$mini->assign('title','你好');
$mini->assign('content','我是内容');

//引入文件
$mini->display('./1.html');
 ?>
