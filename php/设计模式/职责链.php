<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<form action="" method="post">
	<select name="lev" id="">
		<option value="1">骂人</option>
		<option value="3">水贴</option>
		<option value="5">id不好</option>
		<input type="submit" name="提交">
	</select>
</form>
</body>
</html>

<?php 
if(!empty($_POST)){
	$lev = $_POST['lev'];
	(new LZ())->process($lev);
}

class Handler{
	protected $lev = 0;
	protected $up = '';

	public function process($lev){
		if($lev <= $this->lev){
			echo $this->res;
		}else{
			//权限级别过低,new上级 new ($this->up)->process($lev);
			$up = $this->up;
			$uper = new $up;
			$uper->process($lev);
		}
	}

}

class LZ extends Handler{
	protected $lev = 2;
	protected $up = 'BZ';
	protected $res = '删除评论';
}

class BZ extends Handler{
	protected $lev = 4;
	protected $up = 'GM';
	protected $res = '删除帖子';
}

class GM extends Handler{
	protected $lev = 6;
	protected $res = '封禁账号';
}
 ?>