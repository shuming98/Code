	^意思是可不写 []或,{}说明

一、数据增删改查
	1.插入数据:insert into 表(^列名) values (数据);
	2.修改数据:update 表 set 列名=新值 where 限制条件;
	3.删除数据:delete from 表 where 限制条件;
	4.查看数据:select *[列名] from 表 where 限制条件;
	5.查看非null的列:select * from 表 where 列名 is [not] null;

二、查询模型(列是变量，可进行运算和使用函数;where是表达式;值为真(打印)假(不打印))
	1.where比较运算符:<,=,>,>=,<=,!=或<>,in(value,value),bewteen value1 and value2  {in集合,bewteen两者范围内}
	2.where逻辑运算法:NOT 或 ! , OR 或 || , AND 或 && []       {not 非,意思取反。and or 一起用建议加括号}
	3.where匹配: like %通配任意字符 _通配单个字符

三、子句查询 where/group by/having/order by/limit(可任意调用一种,多种调用需要遵守顺序)

	1.group by 分组查询:通常与 avg(),count(),sum(),max(),min()函数使用

	2.having 筛选查询:把SQL运算结果赋值给一个变量，并用having调用

		如:{
		查出2门及2门以上不及格者的平均成绩
		select name,avg(score),sum(score<60) as bjg from result group by name having bjg>=2;
		}

	3.order by 排序查询:select * from 表 order by 列名 asc{默认:升序ascend}
	                                                desc{降序descend}
	                                   order by 列名,列名{多列排序}       

	4.limit 限制查询: select * from 表 order by 列名 limit n1:n2{通常与order by一起使用,n1:跳过几行，n2:去取出几行}

	5.union 查询:把2条或多条SQL语句的查询结果，合并成一个结果集(列要相同) 查询语句1 union 查询语句2	  union all:重复数据不合并

		如:{
		select * from a union(union all) select * from b; 
		}

四、子查询
	1.where 型子查询:查询结果语句→充当→查询限制条件 select * from 表 where 列=上一个查询结果语句

		如:{
		查询每个栏目下最新商品
		select goods_id,goods_name,cat_id from goods where goods_id in (select max(goods_id) from goods group by cat_id);
		}

	2.from 型子查询:查询结果语句→充当→表

		如:{
		查询每个栏目下最新商品(0)
			select cat_id,max(goods_id) from (select * from goods where 1 order by cat_id asc,goods_id desc) as tmp group by cat_id;
		}

	3.exists 子查询:查询条件语句是否存在，存在打印

		如:{
			select * from category where exists (select * from goods where goods.cat_id=category.cat_id);
		}

五、连接查询 {仍可用where等子句查询}

	1.内连接查询(交集):表1 inner join 表2 on 条件

		如:{
			select boy.hid,boy.bname,girl.hid,girl.gname from boy inner join girl on boy.hid=girl.hid;
		}

	2.左连接查询:表1 left join 表2 on 条件 {以左表数据为准,查询右表相对应数据，没有填null}

	3.右连接查询:表1 right join 表2 on 条件 {以右表数据为准}

六、视图
	  view:把语句查询结果保存成一张虚拟表
	  作用:①权限控制;②简化复杂的查询(保存视图，方便下次查询时直接调用)
	  特点:视图与物理表一一对应时可以进行增删改查,经过计算的视图则不能;

1.创建视图:create view 视图名 as [sql查询语句];

2.视图算法:merge(合并)、temptable(临时表) →简化查询

七、事务(engine=innodb)

	1.开始事务:start transaction;  (数据处理)
	2.结束事务:commit;			  (提交)
	3.取消事务:rollback; 			  (回滚)

案例e:银行转账.

特征:隔离性、原子性、一致性、持久性