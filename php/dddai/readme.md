文件配置说明：
①下载安装好xampp集成环境，在mysql中输入：create database dddai;
②项目文件：复制一份.env.example文件，将文件名改为.env 后更改mysql的账号密码等
③在项目文件下，终端输入：composer install
php artisan migrate 
php artisan key:generate
④配置好虚拟主机vhost,本地域名
⑤xxx/grow 生成收益还款账单

users —— 用户表

projects —— 借款项目表s
atts —— 审核借款表
hks —— 借款人还款表(amount 单位/分)

bids —— 投资表(money 单位/分)
tasks —— 投资人预期收益表
grows —— 投资人收益表(amount 单位/元/日)