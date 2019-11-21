# php5.3-PHP7添加的一些新特性

## php5.3
+ Added "?:" operator.
+ Added lambda functions and closures
+ Added support for namespaces.

```php
$x = 3;
echo $x?:'1';
```
```php
function incr($arr , $cb) {
    foreach($arr as $k=>$v) {
        $arr[$k] = $cb($v);
    }

    return $arr;
}

print_r(incr(array(3,4,5) , function ($x){
    return $x + 1;
}));
```

## php5.4
+ Added short array syntax support ([1,2,3]), 
+ Added array dereferencing support.
+ Added class member access on instantiation (e.g. (new foo)->bar()) support.
+ &lt;?= is now always available regardless of the short_open_tag setting.
+ Added binary numbers format (0b001010).
+ Added support for Traits.

```php
// traits 特性

trait Flyer {
    function fly() {
        echo 'flying';
    }
}


trait Runer {
    function run(){
        echo 'running';
    }
}


class SuperMan {
    use Flyer , Runer;    
}


$sm = new SuperMan();
$sm->fly();
$sm->run();

```

## php5.5
+ Added support for constant array/string dereferencing.
+ Added support for using empty() on the result of function calls and other expressions
+ Added Class Name Resolution As Scalar Via "class" Keyword
+ Added support for list in foreach
+ Added array_column function which returns a column in a multidimensional array
+ Added "finally" keyword.
+ Added generators and coroutines.

```php
function getAll() {
   #return [3,4,5,6,7,8,9];
   $arr = [];
   for($i=0;$i<10;$i++) {
     yield $i;
   }
}

foreach(getAll() as $v) {
   echo $v;
}  
```

```php
class T{
  public static function myName() {
    echo __CLASS__;
    echo self::class;
  }
}
```

## php5.6
+ const define constant
+ Added constant scalar expressions syntax
+ Added dedicated syntax for variadic functions.
+ Added support for argument unpacking to complement the variadic syntax.
+ Added an exponentiation operator (**).
+ Added use function and use const..

```php
const PI = 3.14;
echo PI;

const USER = ['lucy' , 'lisi'];
echo USER[1];    
```
```php
function t($a,$b,...$c) {
  var_dump($a);
  var_dump($b);
  var_dump($c);
}

t(1,2,3,4,5);
```

```php
function add($a, $b, $c) {
    return $a + $b + $c;
}

$nums = [2, 3];
echo add(1, ...$nums);
```

## php7

+ The null coalescing operator (??)

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$page = $_GET['page']??1;
echo $page;

+ Return and Scalar Type Declarations
// php弱类型语言
function test3(int $a,int $b):int {
  return $a + $b;
}
echo test3(5,6);

+ Anonymous Classes
// 匿名类
echo (new class {
  public $leg = 4;
})->leg;



## PDO
php5.5,5.6
$pdo = new PDO('mysql:host=localhost;dbname=test' , 'root' , '123456');
print_r($pdo);
$sql = 'set names utf8';
$pdo->query($sql);

/*
$sql = 'select * from test9';
$st = $pdo->query($sql);


print_r($st->fetchAll(PDO::FETCH_NUM));

$sql = 'insert into test9 values (5,"likui" , "黑")';
$pdo->query($sql);
*/


$id = $_GET['id'];

$sql = 'select * from test9 where id=?';
$st = $pdo->prepare($sql);

$st->execute([$id]);

print_r($st->fetch());



$sql = 'select * from test9 where id=' . $id;
$st = $pdo->query($sql);
print_r($st->fetch());