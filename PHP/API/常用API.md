*API 应用程序接口，你需要使用某些授权功能时使用，需要审核，获取APIkey
*通过url发送http请求实现，PHP 可通过以下方式实现
*file_get_contents() 
*fsockopen 打开资源 写入资源 读取资源 关闭资源
*curl curl_init curl_setopt curl_exec curl_close

一、邮件发送
PHP可以搭建本地邮件服务器，但会被大服务商过滤掉(发不出去)，所以还是使用api
邮件发送遵守STMP(发送者->发送服务器)和POP3(接受服务器->接收者)协议
可以使用API，如,搜狐
学习新内容流程：访问官网找到文档->找到代码示例

二、短信发送
可以使用API，如，云片、阿里大于(阿里大鱼)

三、快递查询
可以使用API，如，快递100、爱快递、快递鸟

四、微博、微信授权登陆

五、百度地图