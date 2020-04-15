# 一、PSR-3 日志接口规范

- 规范
    + 日志类库的通用接口规范。
    + 目的是为了让日志类库以简单通用的方式，来记录日志信息。
    + LoggerInterface 接口对外定义了八个方法，分别用来记录八个等级的日志：debug、 info、 notice、 warning、 error、 critical、 alert 以及 emergency 。
    + 第九个方法：log ,第一个参数记录等级。

- 消息
    + 每个方法都接受一个字符串类型作为记录信息。可以携带占位符。
    + 占位符名称用｛｝包含，名称有英文、数字、下划线、句号组成，内容不含空格。

- 上下文
    + 每个记录函数都接受一个上下文数组，记录字符串无法表示的信息。

# 二、实例

- Psr\Log\LoggerInterface 九个方法的实现接口

    ```php
    public function log($level, $message, array $context = array())
    {

    }
    ```

- Psr\Log\LoggerAwareInterface  日志记录实例

- Psr\Log\LogLevel 日志等级常量定义
