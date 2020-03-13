^ []的内容指可选填,{}补充说明

零、数据库入门语句
    1.连接数据库:mysql -uroot -p
    2.查看所有库:show databases;
    3.建库:create database 库名;
    4.删库:drop database 库名;

零_壹、修改数据库密码
    1.不登录mysql: mysqladmin -u用户名 -p password 新密码  
    2.登录mysql: set password for 用户名@localhost = password('新密码');

一、创建表:建表就是声明列的过程。(列，选什么类型的列？列给什么样的属性?)

    语法: create table 表名(
    	列名 类型 属性
    	列名 类型 属性
    	...
    	...
    )表属性;

二、列类型

1.整型类:bigint 8字节(0~1.8千万京)
        int  4字节(0~42亿)
        mediumint 3字节(0~1.6千万)
        smallint 2字节(0~65535)
        tinyint 1字节(0 ~ 255,默认带符号-128 ~ -127)

  整型可选参数: unsigned 无符号,列值从0开始,不为负
              zerofill 零填充,宽度不足用0填充,默认unsigned,适用于学号、编码. 如:tinyint(4) zerofill

2.浮点型:float(M,D) [unsigned] [zerofill]      {M:总位数,D:保留小数点后几位}
        double(M,D) [unsigned] [zerofill]     {double比float更大,浮点型会有精确度损失}

3.定点型:decimal(M,D) [unsigned] [zerofill]     {定点型,比浮点型更精确}

4.字符型:char(M) 0~255
        varchar(M) 0~6万多 {M:指占M几个字符,小用char,大用varchar}
        text(M) 存大段本文
        blob    以二进制存储数据(包括图像、音频等)
        enum('值1','值2')    枚举型,控制表格只能填定义好的值,可插入值得索引1,2,3....如性别,emum('男','女')
        set('值1','值2','值3'...)      集合,可插入集合内一个或多个值

5.日期时间类型:year 年(占一个字节) 1901~2155    now()
             date 日期(2018-8-25)
             time 时间（13:11:26）
             datetime 日期时间(2018-8-25 13:12:44)
             timestamp 时间戳  default current_timestamp

三、列属性

1.列的默认值: not null default '值'
{默认值设置需遵守类型格式。字符需要加单引号,数字不需要,中文需要加字符集声明charset utf8}

2.主键与自增: 主键:primary key (主键列数据不重复,能够区别每一行进行索引)
            自增:auto_increment (自增只能加在索引上,且只能设置一列)
            {主键自增通常并用,如:id smallint primary key auto_increment}

3.建表时为字段添加注释: comment ''

	^到这里建表教程已经完成，接下来看看如何操作列

四、列的操作(增删改查)

1.增加一列:alter table 表名 add 列名 列类型 列属性 [after 列名]; {after 列名(first) 是指定新列在那个位置}
2.修改一列:alter table 表名 change 原列名 新列名 列类型 列属性;   {这个不但可以改类型属性，换可以改名}
         alter table 表名 modify 列名 列类型 列属性;
3.删除一列:alter table 表名 drop column 列名;

五、表/视图管理语句

    1.查看所有表:show tables;
    2.查看表结构:desc 表名/视图名;

    3.查看建表过程:show create table 表名;
    4.查看建视图过程:show create view 视图名;

    5.查看表信息:show table status;
    6.查看某张表详细信息:show table status where name='表名'\G;

    7.修改表名:rename table 原表名 to 新表名;
    8.清空表数据:truncate 表名;     {相当于删表再重建}

    9.删除表:drop table 表名;
    10.删除视图:drop view 视图;

六、建表属性

1.引擎:engine=innodb      {myisam处理速度快,但不安全,innodb处理速度慢,但安全功能多,支持事件}
      ①查看引擎:show engine;
      ②修改引擎:alter table 表名 engine=??;

2.字符集:charset utf8

    ①查看数据库字符集:show variables like '%charact%';
    
    ②三步搞点字符集乱码问题:①php文件:<meta charset="utf-8">
       (字符集保持一致)    ②建表:create table 表名()engine=innodb,charset utf8;
                        ③连接数据库:set names utf8;

七、索引(数据目录，快速定位数据位置)
1.索引概念:①普通索引:key
         ②唯一索引:unique key {数据不重复}
         ③主键索引:primary key
         ④全文索引:fulltext    {中文环境下无效,要分词+索引,用sphinx解决}

2.创建索引:①建表时,把主键索引可当作列属性添加:primary key;
         ②建表时,在列后面添加:索引 索引名(列名)  如,key name(name) {索引名通常和列名相同}
           主键：primary key(colName);
           外键：foreign key(colName) references table2(colname)
           [on delete cascade] table2表中记录被删的同时会删除本表相关外键记录

3.索引类型:①索引长度:可以索引前一部分内容。如,unique key email(email(10))
          ②多列索引:两列或多列的值看作一个整体建立索引。 如,key id(id,name); {左前缀原则}
          ③冗余索引:某列上可能存在多个索引。 如,key id(id,name),key name(name)

4.索引操作
①查看索引:show index from 表名;

②增加索引:alter table 表名 add index/unique 索引名(col_name);
         create index 索引名 on tableName(colName);
③删除索引:alter table 表名 drop index col_name;
         drop index 列名 on 表名;
 
④添加主键索引:alter table 表名 add primary key(col_name);
⑤删除主键索引:alter table 表名 drop primary key;

八、备份数据库
1.备份所有库:mysqldump -u root -p --all-databases > filename.sql
2.备份库:mysqldump -u root -p --databases(-B) 库名 > filename.sql
3.备份所有表:mysqldump -uroot -p 库名 > filename.sql
3.备份表:mysqldump -u root -p 库名 表名 > filename.sql
4.数据还原:mysql -u root -p 库名 < filename.sql

九、表命名规范
1.关联表名应该是被关联表用'_'连接组成。如：work_issue
2.字段名,前两位表名缩写.'_'连接组成。如：cats表有ct_id,ct_name.
3.常用字段使用固定定义。如是否删除：delornot
4.索引名和表名相同。
