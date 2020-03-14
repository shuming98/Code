<?php 
class Human{

	public $name=null;
	public $gender='boy';
	public $age=20;

	public function __construct($name){
		$this->name=$name;
		$this->gender;
	}
	public function __destruct(){
		echo '对象被销毁！';
	}
	
}
$chaomao=new Human('chaomao');
echo $chaomao->name,'<br/>';
echo $chaomao->gender,'<br/>';
echo $chaomao->age,'<br/>';
echo '<hr/>';
?>