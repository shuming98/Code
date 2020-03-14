<?php 
namespace Home\Controller;
use Think\Controller;
class UserController extends Controller{
	public function haha(){
		echo '自己写Controller','<br/>';
		
		echo C('DB_TYPE'),'<br/>';
		C('DB_haha',123);
        echo C('DB_haha'),'<br/>';

        echo '$_GET:',I('id'),'<br/>';

        echo '$_POST:',I('name'),'<br/>';

        echo '$_POST_ALL:',var_dump(I('post.')),'<br/>';


		$this->display(); //显示模板，名字一致方便引用
	}

	public function mysql(){
		//使用model
		//$model = new \Home\Model\UserModel();
		$model = D('User'); //D(表名)

		//数据库增删改查
		//面向过程
		$data = array('id'=>1,'name'=>'小李','gender'=>'男');

		#//$model->add($data);//*增
		#//$model->where('id=2')->save(array('id'=>3,'gender'=>'男'));//*改

		//面向对象
		$model->id = 2;//__isset 魔术方法
		$model->name = '小王';
		$model->gender = '女';

		//$model->add();//*增
		//$model->save(); //*改

		//*查
		$data = $model->find('1'); //id查一条数据
		$data = $model->select(); //全查
		$data = $model->where("gender='男'")->select(); //where条件查询
		$data = $model->where('id>0')->order('id asc')->limit(5)->select();//搭配查询

		//*删
		//$model->delete(1,2,3); //根据id删除
		//$model->where('id=1')->delete(); //根据条件删除


		print_r($data);
	}

	public function op_assign(){
		$this->assign('num',rand(1,9)); //赋值->和smarty类似(一样)
		$this->assign('three',rand(0,1));
		$arr = ['数','组'];
		$this->assign('array',$arr);
		$this->display();
	}

}
 ?>
