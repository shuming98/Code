<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends Controller {
    public function login(){
        if(!IS_POST){
            $this->display();
        }else{
            if($this->checkyzm(I('post.yzm')) == true){
               $user = D('user')->where("username="."'".I('post.username')."'")->find();
                if(md5(I('post.password').$user['salt']) == $user['password']){
                    cookie('username',$user['username']);
                    cookie('user_id',$user['user_id']);
                    cookie('ccode',md5($user['username'].C('DB_SALT')));
                    $this->redirect('/');
                }else{
                    $this->redirect('msg');
                }
            }
        }
    }

    public function logout(){
        cookie('username',null);
        cookie('ccode',null);
        $this->redirect('/');
    }

    public function yzm(){
    	$v = new \Think\Verify();
    	$v->imageW = 150;
    	$v->imageH = 40;
    	$v->fontSize = 20;
    	$v->length = 4;
    	$v->useCurve = false;
    	$v->useNoise = false;
    	$v->entry();
    }

    public function checkyzm(){
    	$v = new \Think\Verify();
    	if($v->check(I('post.yzm'))){
    		return true;
    	}else{
            echo '验证码错了';
    	}
    }

    public function reg(){
        if(!IS_POST){
            $this->display();
        }else{
            $model = D('User');
            if(!$model->create()){
                echo $model->getError();
            }else{
                $salt = $this->salt();
                $model->password = md5($model->password.$salt);
                $model->salt = $salt;
                if($model->add()){
                    $this->redirect('Home/User/login');
                }
            }
        }
    }

    public function salt(){
        return mt_rand(1000,9999);
    }
}