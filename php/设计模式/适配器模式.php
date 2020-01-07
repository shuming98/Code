<?php 
/**
 * 天气类,摄氏度显示
 */
class TQ{
	public function today(){
		//调用一堆接口
		//code...
		
		return [
			'wendu' => mt_rand(20,37),
			'feng' => mt_rand(20,100), 
		];
	}
}

/**
 * 日本温度华摄度显示，写一个转换类
 */
class Jp{
	protected $tq;
	public function __construct(){
		$this->tq = new TQ();
	}

	public function today(){
		$res = $this->tq->today();
		$res['wendu'] =  $res['wendu']*1.8+32;
		$res['feng'] = floor($res['feng']/10);

		return $res;
	}
}

$jp = new Jp();
print_r($jp->today());
 ?>
