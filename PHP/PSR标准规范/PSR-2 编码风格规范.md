# 一、PSR-2 编码风格规范

- 代码：
    + 代码缩进是个空格符而不是「Tab 键」。
    + 纯 PHP 代码省略最后的 ?> 结束标签。
    + 关键字小写形式。如，true，false，null。

- 行：
    + 每行的字符数是 80 个之内，最大不能多于 120 个
    + 所有 PHP 文件必须以一个空白行作为结束。

- 类：
    + namespace 和 use 语句下一行是空白行。

    + 类和方法 {} 必须是独立一行。

    + 类的属性和方法
        + 必须添加访问修饰符（private、protected 以及 public），
        + abstract 以及 final 必须声明在访问修饰符之前，
        + 而 static 必须 声明在访问修饰符之后。

- 控制结构：
    + 关键字后面有一个空格符，方法和函数不需要有。
    + 花括号｛ 写在声明的同一行，而结束花括号 } 自成一行。
    + 括号 () 左右不能有空格，运算符、分号需要加空格。

# 二、示例

## 1.类
    <?php
    namespace Vendor\Package;

    use FooInterface;

    class Foo
    {
        final public static function bar()
        {
            // 方法体
        }
    }

## 2.控制结构
    <?php
    if ($expr1) {
        // if body
    } else {
        // else body;
    }

    while ($expr) {
        // 结构体
    }
    
    for ($i = 0; $i < 10; $i++) {
        // for 循环主体
    }

    foreach ($iterable as $key => $value) {
        // foreach 主体
    }