零、三个缓存系统的区别：

	1）Memcached：内存->缓存,存储 字符串
	2）Redis：内存->缓存、存储,可以存储 字符串、链表、集合、哈希
	3）MongoDB：文档数据库，存储 文档(Bson -- json的二进制化)
	
		①特点：内部执行引擎为JS解释器,把文档存储成bson结构,在查询时,转换为JS对象,并可以通过熟悉的js语法来操作.

		②json语法：A.{key:'value'...}
				   B.{
					   	'array':[
						   	{'key':'value'...},
						   	{'key':'value'...},
							...
					   	]
				   	 }

		③适用场景：MongoDB 效率并不高,应用在改动不大,结构复杂,历史档案,归档数据。	

一、下载(下载后可以直接使用,不需要编译,非开源软件)

	1）下载：wget https://fastdl.mongodb.org/osx/mongodb-macos-x86_64-4.2.1.tgz
	2）解压：tar -zxvf xxx

二、基本命令操作（默认端口：27017）

	1）启动服务：./bin/mongod
	
		param:[
			{--dbpath /path},	数据位置
			{--logpath /path/file.txt},	日志位置(文件)
			{--port 27017},	端口
			{--fork}	后台运行
		]

	2）连接服务器：./bin/mongo
	
	3）简单入门语句
		(collection:集合; {}:文档; name->集合名; {}->json格式;)

		A.查看数据库：show dbs
		B.选库/创库：use dbName

		E.查看集合：show collections/tables
		F.创建集合：db.createCollection('name')
		G.插入时隐式创建：db.name.insert(document)	

		J.删除集合：db.name.drop()
		K.删除库：db.dropDatabase()
	
	4）增删改查语句

		A.增加语法：db.name.insert(document)
		B.增加单篇文档：db.name.insert(document)
		C.增加多篇文档：db.name.insert([{key:value},{}...])
		D.指定_id：db.name.insert({_id:8,key:value ...})

		A.删除语法：db.name.remove(query,option)
		B.删除文档：db.name.remove({key:value})
		C.只删除一行：db.name.remove({key:value},true)
			(相同的数据可能会在多行出现)

		A.修改语法:db.name.update(query,update,option)
		B.新文档替换旧文档：db.name.update({key:value},{newkey:newvalue})
		C.修改文档字段：db.name.update(query,{$set:{newkey:newvalue}})
			update:[
				{$set:{}} 	修改某字段的值,
				{$unset:{}} 	删除某字段,
				{$rename:{}} 	重命名某字段,
				{$inc:{}} 		增长某字段的值，
				{$setOnInsert:{}} 	upsert & insert 为true时,可以补充的字段
					]

			option:[
				{upsert:true/false} 	匹配不到时,直接添加,
				{multi:true/false} 		修改多行
			]
		
		A.查询语法：db.name.find(query,option)
			.pretty()[格式化显示].skip(n)[跳过N行].limit(n)[取N行]
		B.查询所有文档：db.name.find()
		C.查询所有文档的key属性：db.name.find({},{key:''})
		D.查询key属性不查询_id：db.name.find({},{key:'',_id:0})
		E.查询所有文档的key属性：db.name.find({key:value},{key:value})
			(加前置条件限制)
	
			query:[
				{key:value} 	查询某列,
				{key:{$ne:value}} 	查某列值与value(比较大小),
				{key:{$in:[min,max]} 值在该范围内,
				{key:{$nin:[min,max]} 值不在该范围内,
				{key:{$all:[value,value2...]}} 	值是一个数组,包含以上数据,
				{key:{$exists:1}} 	查询含有key字段的文档,
				{key:{$nor:[where,where2 ..,]}} 	所有条件均不满足的文档,
				{key:/*/} 	正则查询,
				{$where:'this.key!=value'} where语句查询

			]

			
	5）游标操作
		（游标不是查询结果，而是查询的返回资料，可以根据此逐条读取）

		A.声明游标：var cursor = db.name.find(query,option)
		B.取下一行：cursor.next()
		C.判断是否尽头(返回false)：cursor.hasNext()
		D.查询所有数据：cursor.toArray()
		E.查询某条数据：cursor.toArray()[n]

	6）索引创建

		A.创建索引：db.name.ensureIndex({field:1/-1})
			(filed:字段；1是升序；-1是降序)
		B.创建唯一索引：db.name.ensureIndex({field:1},{unique:true})
		C.创建稀疏索引：db.name.ensureIndex({field:1},{sparse:true})
		D.创建哈希索引：db.name.ensureIndex({field:hashed})
		E.创建多个索引：db.name.ensureIndex({field:1,...})
		F.创建子文档索引：db.name.ensureIndex({'filed.subfield':1})

		G.删除索引：db.name.dropIndex({field:1/-1})
		H.删除所有索引：db.name.dropIndexes();

		I.查看索引：db.name.getIndexes()
		J.重建索引：db.name.reIndex()
	
	7）导入导出

		A.导出json文件：./mongoexport -d 库名 -c 集合 -o 文件名.json
			(-f 字段; -q 条件语句,如{key:{$lt:200}};)
		B.导出csv文件：./mongoexport -d 库名 -c 集合 --type=csv -o 文件名.csv

		C.导入json文件：./mongoimport -d 库名 -c 集合 --file 文件名.json
		D.导入csv文件：./mongoimport -d 库名 -c 集合 --type csv --headerline --file test.csv

		E.导出bson文件：./mongodump -d 库名 -c 集合 
			(存放在当前目录下dump/name)
		F.导入bson文件：.mongorestore -d test --dir dump/name

三、MapReduce(运用数学函数)

	1）MapReduce是一种编程模型,用于大规模数据集的并行运算；
		Map(映射) 和 Reduce(归纳) 是它的主要思想；
		Map：把同组数据映射到一个数组上，Reduce:把数组的数据进行运算；
		特点：分布式、可靠性。

	2）MongoDB中如何使用
		（假设你已经引入了大量goods数据）

		①Map函数：

			var map = function(){
				emit(this.cat_id,this.goods_number);
			}
			//统计各栏目的商品总数

		②Reduce函数：

			var reduce = function(cat_id,nums){
				return Array.sum(nums);
			}
			//把商品数量放在nums数组里，并统计总数

		③执行并查询：

			db.goods.mapReduce(map,reduce,{out:'res'})
			db.res.find()
			//执行并输出至res集合中

		④SQL会如此写：

		select cat_id,sum(goods_number) from goods groupby cat_id;

四、用户管理
	(用户以数据库为单位建立的,每个数据库都有自己的管理员;
	牵涉到服务器配置层面的操作,都需要切换到admin数据库.)

	A.切换到admin：use admin
	B.查看用户：db.getUsers()
	C.添加用户：

		db.createUser({
			user:'root',
			pwd:'123456',
			roles:[{role:'xxx',db:'admin'}]
		})

	D.认证用户：db.auth(user,pwd)
	E.修改密码：db.changeUserPassword(user,newpwd)
	F.删除用户：db.dropUser(user)
