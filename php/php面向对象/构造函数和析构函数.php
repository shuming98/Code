<?php 
class Human{
	public function __construct($name){
		$this->name=$name;
		$this->gender;

	}
	public function __destruct(){
		echo '对象被销毁！';
	}
	public $name=null;
	public $gender='boy';
	public $age=20;
}
$chaomao=new Human('chaomao');
echo $chaomao->name,'<br/>';
echo $chaomao->gender,'<br/>';
echo $chaomao->age,'<br/>';
echo '<hr/>';
?>