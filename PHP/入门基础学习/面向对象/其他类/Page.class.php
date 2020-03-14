<?php 
/**
* 分页类
* @author PHPer
*/
abstract class aPage {
    public $size = 5; // 显示多少个页码
    public $error = '';
    public $offset = 0; // limit offset

    /**
     * 计算分页代码
     * @param int $sum 总数量
     * @param int $num 每页数量
     * @param int $curr 当前页码
     */
    abstract public function getPage($sum , $num , $curr);
}

class Page extends aPage{
    public $size = 5; // 显示多少个页码
    public $error = '';
    public $offset = 0; // limit offset

    /**
     * 计算分页代码
     * @param int $sum 总数量
     * @param int $num 每页数量
     * @param int $curr 当前页码
     */
    public function getPage($sum , $num , $curr=1){
    	//左右页码均值
    	$avg = ceil($this->size / 2);

    	//最大页码数
    	$max = ceil($sum / $num);

    	//最左侧页码
    	$left = max($curr - $avg,1);

    	//最右侧页码
    	$right = min($left + $this->size - 1,$max);
    	$left = max($right - $this->size + 1,1);

    	/*	(1 [2] 3 4 5) 6 7 8 9 
		1 2 (3 4 [5] 6 7) 8 9
		1 2 3 4 (5 6 7 [8] 9)*/
    	for($i = $left,$pages = array();$i <= $right;$i++){
    		$_GET['page'] = $i;
    		$pages[$i] = http_build_query($_GET);
    	}
    	$this->offset = ($curr - 1) * $num;

    	return $pages;
    }
}

/**
 * @funciton new调用
 */
$curr = isset($_GET['page']) ? $_GET['page'] : 1;
$pages = (new Page())->getPage(20,3,$curr);


/**
 * @function 显示页码
 */

//上一页
if($curr>1){
	$_GET['page']=$curr-1;
	echo '<a href="./Page.class.php?',http_build_query($_GET),'">&lt;</a>';
	}
	
//显示页码
foreach($pages as $k=>$v){
	if($k == $curr){
		echo '<span style="padding:5px">',$k,'</span>';
	}else{
		echo '<a href="./Page.class.php?',$v,'" style="padding:5px">',$k,'</a>';
	}
}

//下一页
end($pages);
if($curr<key($pages)){
$_GET['page']=$curr+1;
echo '<a href="./Page.class.php?',http_build_query($_GET),'">&gt;</a>';
}
?>