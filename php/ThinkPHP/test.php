<?php
一、框架的意义
1）减少重复劳动
2）便于团队配合
3）增强安全性
4）面试和工作的需要

二、为什么要学习ThinkPHP
1）国内公司用的多
2）框架基本是MVC框架，学一则通

三、框架学习步骤
1）安装引入
2）控制器使用
3）引入模板view
4）写Modal类
5）如何配置
6）modal操作
7）模板语法

四、ThinkPHP
1）网站地址访问：DocumentROOT/index.php/模块名称/控制器/方法
xxxx/index.php/Home/Index/index(方法)
#控制器：IndexController.class.php(只用写Index,后面是系统自动加的，不用写)

2.写$_GET['id'] 地址栏上写 ‘/id/8’

3.控制器Controller————处理数据
1）位置：每个模块的Controller目录下 
2）文件名：控制器名Controller.class.php[大驼峰命名](与类名一致)
3）命名空间：namespace Home\Controller
4）继承类：use Think\Controller
5）访问：DocumentROOT/index.php/模块名称/控制器/方法
6）首页默认返回：Index/index文件内容

4.模板View————输出数据(变量)
1）每个控制器的模板，要在与控制器同名的目录下(访问路径一样)
2）模板名和方法名是对应的，一致的
如 地址栏：index.php/Home/User/ha
   控制器：Home/UserController
   方法：haha
   模板：Home/View/User/haha.html
3）位置：xxx/index.php/Home/view/控制器/方法.html
4）访问：xxx/index.php/Home/控制器/方法(与控制器访问一致)

5.模型Model
1）位置：/Home/Modal/xxModel.class.php
2）文件名：model名称与表名table相同，如stu表，StuModel.class.php
3）命名空间：namespace Home\Model
4）继承类：use Think\Model
5）访问前，需要写数据库配置文件

6.配置文件
1）TP自带配置文件：/ThinkPHP/Conf/convention.php
2）项目公共配置文件：/Common/Conf/config.php
(从1）中复制内容到2）)
3）配置文件优先级：[就近原则]先找/Home/Conf 再找/Common/Conf

7.引入css,js文件
1）以Public为根目录 如,/Public/a/b/c.css
2）<import type="css/js" file="a.b.c" />
3）<load href="__PUBLIC__/a/b/c.css"/>

8.引入html共同文件(头、尾)
1）例如,/Home/View/Public/header.html
2）<include file="Public/header[模板名(不含后缀)]" />

9.全局函数
1）M函数：找父类实例化  	 M('Model名');//表名

2）D函数：优先找子类实例化   D('Model名');//表名
①跨模块：文件目录：Admin/Controller/Index/index
				 new \Home\Model\CatModel();
				 D('Home/Cat');

3）U函数：按照系统设定的URL规则，生成URL
①主要用途：在我们删除/修改/传值时使用地址栏进行跳转时使用的函数
②View使用：$url = U('模块/控制器/方法',参数字符串或数组)
	   如:{:U('Home/User/haha','array('id'=>5,'page=3'))}
	      {:U('Home/User/haha','id=5&page=3')}
	      {:U('Home/User/haha','id=$good_id')}  //assign变量不用加{}
③input:type{hidden} 传参	


4）C函数：读取和设置配置选项的函数
①Controller使用：echo C('DB_TYPE'); //读取
                 C('DB_haha',123);  //设置
                 echo C('DB_haha');

5）I函数：接受 GET/POST 传参，防XSS攻击和SQL注入
①Controller使用：var_dump(I('name'));
				 var_dump(I('post.'));
				 I('get.name');

10.一些函数
1）IS_POST 判断是否有post数据

2）跳转	
①$this->success('提示信息','跳转页面[方法]',N秒后跳转); 
(当前路径：当前控制器,默认跳转返回上一页)
如,'catelist' 或 U('Admin/Cat/catelist')
        
②$this->redirect('跳转页面');
如,首页:'/' ; 当前控制器页面:'msg' ; 其他页面:'Home/User/msg'

3）create() 	自动分析POST数据,并复制到Model的“数据对象上”
①create()后可直接D('table')->add()

4）自动验证
①定义[Model]:
	protected $_validate = array(
		array(验证字段,验证规则,错误提示,[验证条件],附加规则,验证时间),
		array('username','8,16','用户名需6-16个字母或数字'1,'length',3)
	......
	);
②调用[Controller]:
	if(!D('User')->create()){D('User')->getError();}

5）自动填充
①定义[Model]:
	protected $_auto array(
		array(完成字段,完成规则,[完成条件,附加条件]),
		array('add_time','time',1,'function')
	);

6）自动过滤
①定义[Model]:
	protected $insertFields = '字段名';
	protected $insertFields = 'id,username,password,add_time';

7）无限级分类(重点--表设计,关键parent_id)
	class CatModel extends model{
		protected $cats = array();
		public function __construct(){
			parent::__construct();
			$this->cats = $this->select();
		}

		//无限级分类
		public function getTree($parent_id=0,$lev=0){
			$tree = array();
			foreach($this->cats as $c){
				if($c['parent_id'] == $parent_id){
					$c['lev'] = $lev;
					$tree[] = $c;
					$tree = array_merge($tree,$this->getTree($c['cat_id'],$lev+1));
				}
			}
			return $tree;
		}
	}

8）文件上传
	$upload = new \Think\Upload();
	$upload->exts = array('jpg','gif','png','rar','zip');
	$upload->rootPath = './Public/up/';
	$info = $upload->upload();
	if($info){$_POST['goods_img'] = '/Public/Up/'.$info['goods_img']['savepath'].$info['goods_img']['savename'];}
	else{var_dump($upload->getError());}

9）图片缩放(需手动创建文件夹)
	$img = new \Think\Image();
	$img->open('path');
	$img->thumb(width,height)->save('path');

10）分页功能
	$model = D('Goods'); //连库
	$count = $model->count(); //查询总数
	$Page = new \Think\Page($count,10); //设置new一个类并每页显示条数
	$show = $Page->show();	//输出分页数组
	$goods = $model->field('goods_id,goods_name,goods_sn,shop_price,is_on_sale,is_best,is_new,is_hot,goods_number')->order('goods_id desc')->limit($Page->firstRow.','.$Page->listRows)->select();  //配合limit使用
	$this->assign('page',$show);  //赋值前端 {$page}
	$this->assign('goods',$goods);
	$this->display();

11）验证码
   public function yzm(){
    	$v = new \Think\Verify();
    	$v->entry();
    }
    <img src="{:U('Home/User/yzm')}" alt="yzm" >

12）登录与退出Cookie
//登录
①cookie('username',$user['username']);
  cookie('ccode',md5($user['username'].C('DB_SALT')));
  $this->redirect('/');

//退出
②cookie('username',null);
  $this->redirect('/');

//cookie加盐验证 /Common/function.php
③function cookie_check(){
	(md5(cookie('username').C('DB_SALT')) === cookie('ccode'))?return 1:return 0;
}

//View
④<if condition="cookie_check() eq 0">
	没登录状态
	<else/>
	登录状态{$Think.cookie.username}
  </if>

13）Session
①设置：session('name','value');
②判断：session('?name')
③输出：session('name');

14）引入第三方库(类)
1）新建文件路径;如：/Home/Tool/OtherTool.class.php
2）写类：
namespace \Home\Tool;
class OtherTool{	//类与文件同名
	public function xx(){.....}
}

3）C层使用：
//new \Home\Tool\OtherTool();
use \Home\Tool\OtherTool;
new OtherTool()->xx();

15）关联模型[Model -> Controller]
①数据库表：一对一,一对多,多对多

②[Model/xxxModel.class.php] 继承RelationModel

namespace Home\Model;
use Think\Model\RelationModel;
class GoodsModel extends RelationModel { //如goods
	protected $_link = array(
	'comment'=>self::HAS_MANY //'关联表名',静态本类,self::继承
);
}

③[Controller/GoodsController.class.php] 关联查询

D('Goods')->relationGet('comment'); 

//自动调用goods表主键来查询comment
//一对一建议使用关联模型简化操作

16）URL美化(写在Common/Conf/config.php 配置文件里)
[0 普通模式,1 PATHINFO模式,2 Rewrite模式,3 兼容模式]

①'URL_MODEL' => 1(默认) /index.php/模块名/控制器/方法

②rewrite模式 /模块名/控制器/方法(不用写index.php)
开启此模式需两步：
A.开启apache中重写模式
 LoadModule rewrite_module modules/mod_rewrite.so 

B.网站根目录下创建".htaccess"文件,写入以下内容(正则)：
<IfModule mod_rewrite.c>
RewriteEngine on RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^(.*)$ index.php/$1 [QSA,PT,L]
</IfModule>

③兼容模式 index.php?s=/模块名/控制器/方法

④其他配置：
//默认false 表示URL区分大小写 true则表示不区分大小写'
'URL_CASE_INSENSITIVE' => true,
// PATHINFO 1模式下,各参数之间的分隔符
'URL_PATHINFO_DEPR' => '/',

17）缓存[有大量查询且变化不大的地方需要缓存]
①S()
如:public function catelist(){
	$catModel = D('Cat');
	$cat = S('catlist');	//缓存谁？
	if($cat == false){
		echo '这是数据库出来的数据'; 
		$catlist = $catModel->getTree();  //取库缓存
		S('catlist',$catlist,5);	//设置缓存
	}else{
		echo "这是缓存出来的数据"; 
		$catlist = $cat; //输出缓存
	} 
}

②快速缓存:F() 与S()一样,不用填有效期,手动删除之前,永久有效

③查询缓存:查询时候添加 cache(true),下次查询不再拼接SQL语句
如:D('table')->cache(true)->select()



View
1）
<foreach name="cats" item="v" key="k">
	....{$v[xxx]}
</foreach> 

2）<if condition="{goods['xxx'] eq 0}"> //可以使用php函数
	.....
	<elseif>
		.....
		<else/>
		......
	</if>

3）获取系统变量：{$Think.} 如{$Think.cookie.username}

4）调用变量:{$var.name} {$var['name']} "$var['name']"

5）可以直接使用/Common/function.php里的函数

6）引入头尾模板:
①<incldue file="Public/header" title="传入变量" /> 
(如:View/Public/header.html [title]赋值)
②<include file="./Application/Home/View/Public/header.html" />

SQL操作
1）查看sql语句：D('table')->getLastSql();
2）表达式查询(例如，模糊查询):
$map['name'] = array('like','%$name%');
D('table')->where($map)->select();