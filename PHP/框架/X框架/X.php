<?php  
define('X_PATH',__DIR__);
require(X_PATH . '/XBase.php');

class X extends XBase{

}

/**
 * 自动加载映射
 * @var [type]
 */
X::$classMap = [
	'App'=>X_PATH . '/Base/App.php',
	'Controller'=>X_PATH . '/Base/Controller.php',
	'XBase'=>X_PATH . '/XBase.php',
	'X'=>X_PATH . '/X.php',
];

spl_autoload_register('XBase::autoload');
(X::app())->run();
?>