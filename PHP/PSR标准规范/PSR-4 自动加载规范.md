# 一、PSR-4 自动加载规范

- 描述了从文件路径中自动加载类的规范。
- 给可交互的 PHP 自动加载器指定一个将命名空间映射到文件系统的规则
- 规范了命名空间、类名、文件路径的关系。

# 二、实例

## 1.全限定类名、命名空间前缀和根目录
- 文件所在目录：./vendor/Symfony/Core/
- 文件完整路径：./vendor/Symfony/Core/Request.php
- 命名空间前缀：Symfony\Core
- 全限定类名：\Symfony\Core\Request
