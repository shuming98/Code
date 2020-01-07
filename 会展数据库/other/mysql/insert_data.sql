use uee;

insert into login(account,password) values ('root','123456'),
	('shuming','123456'),('guest','000000');

insert into account(id,username,password) values 
(1,18174348844,'dDvCTEy_'),
(2,18544862381,'JlFa*=Q!Vu'),
(3,13815649822,'K866K9ief'),
(4,13049703619,'sEO4R~9D'),
(5,13036577114,'BDuNtF=aZ'),
(6,15330563024,'aM+rca*YBG*'),
(7,13648032569,'Lez!KoekZf9W'),
(8,15297579512,'Ttg*GfoIhAvRn'),
(9,18162581003,'l!4i6olfQQY'),
(10,15224091017,'maUYuW70'),
(11,18857925201,'tnF8_xgI'),
(12,18676298213,'AUQ8aeQ_7'),
(13,14778055114,'YMBfFR8B`'),
(14,18583173948,'F8w0d63d!'),
(15,18387714011,'nPFcppd*HX'),
(16,13071832386,'jkc~BwURek'),
(17,18431925197,'sW9jKmZxFLl'),
(18,18268232599,'FJBIazD*-E7C'),
(19,15891527817,'jyy!PbqF573'),
(20,18715419189,'tLR~r1PZH`X+'),
(21,13264706729,'x6yQ=nU!iv0cy'),
(22,13554978920,'yc1MuVeTIvnix'),
(23,17624907571,'w~32EvLfU'),
(24,15928011403,'fHGHZLFX=RR'),
(25,18131377946,'0ElDsDtKS'),
(26,15554327186,'IPP`dmeMB3'),
(27,13015168202,'CGz`wNt1vIA'),
(28,18075458328,'HO^^OmF=qRtg5'),
(29,15692834643,'w~32EvLfU'),
(30,15359233996,'HU_o*rXafE3');

insert into user(id,name,gender,age,income,tend,mobile_number,email) values 
(1,'曹振乐','男',18,0,'零售类',18174348844,'4665092357@qq.com'),
(2,'上官元','女',22,'<5000','娱乐类',18544862381,'3224833974@qq.com'),
(3,'陆峰娜','女',18,0,'餐饮类',13815649822,'2196344515@qq.com'),
(4,'东建','男',30,'5000-10000','娱乐类',13049703619,'845263279@qq.com'),
(5,'奚恒','男',28,'<5000','生活类',13036577114,'4964353816@qq.com'),
(6,'堵功琰','男',32,'5000-10000','生活类',15330563024,'6655552292@qq.com'),
(7,'卞荷','女',34,'5000-10000','生活类',13648032569,'9572745059@qq.com'),
(8,'濮阳雨欢','女',30,'<5000','零售类',15297579512,'5439335748@qq.com'),
(9,'方亮','男',26,'5000-10000','餐饮类',18162581003,'5122799499@qq.com'),
(10,'喻英','女',21,0,'生活类',15224091017,'638215397@qq.com'),
(11,'邱达霞','女',22,'5000-10000','娱乐类',18857925201,'8775410544@qq.com'),
(12,'司马菲','女',23,'<5000','生活类',18676298213,'4710467972@qq.com'),
(13,'师咏露','女',50,'>10000','零售类',14778055114,'2166165256@qq.com'),
(14,'宰固琪','女',19,0,'生活类',18583173948,'9712046777@qq.com'),
(15,'丁瑾斌','男',25,'5000-10000','生活类',18387714011,'1587591819@qq.com'),
(16,'杜彪璧','男',19,'<5000','零售类',13071832386,'4179451336@qq.com'),
(17,'郑萱','女',45,'>10000','娱乐类',18431925197,'2522333112@qq.com'),
(18,'谈毓武','男',23,0,'健康类',18268232599,'897471115@qq.com'),
(19,'贡航堂','男',23,'<5000','娱乐类',15891527817,'3125492580@qq.com'),
(20,'赖健蕊','男',25,'<5000','餐饮类',18715419189,'140862426@qq.com'),
(21,'欧阳娣丹','女',23,'5000-10000','零售类',13264706729,'535643052@qq.com'),
(22,'许琴涛','女',36,'5000-10000','零售类',13554978920,'234488988@qq.com'),
(23,'张涛若','男',18,0,'健康类',17624907571,'661575494@qq.com'),
(24,'施君','男',33,'5000-10000','零售类',15928011403,'556161863@qq.com'),
(25,'令狐雅思','男',18,0,'娱乐类',18131377946,'269015721@qq.com'),
(26,'赫连蓓','女',41,'5000-10000','餐饮类',15554327186,'366071511@qq.com'),
(27,'阮苇瑗','女',34,'<5000','零售类',13015168202,'848002136@qq.com'),
(28,'胥绿','女',38,'5000-10000','生活类',18075458328,'681722616@qq.com'),
(29,'符博恒','男',48,'>10000','健康类',15692834643,'916908005@qq.com'),
(30,'尤桦秀','女',29,'<5000','健康类',15359233996,'566236876@qq.com');

insert into exhibitor(id,username,enterprise,address,tel,email,application,type,number) values
(1,'曹振乐','缤果盒子','广东中山',18174348844,'4665092357@qq.com','零售类','标准展台单开',2),
(2,'上官元','友唱','福建厦门',18544862381,'3224833974@qq.com','娱乐类','标准展台双开',3),
(3,'陆峰娜','麦当劳','美国',13815649822,'2196344515@qq.com','餐饮类','豪华展台双开',2),
(4,'东建','功夫豆','江苏南京',13049703619,'845263279@qq.com','娱乐类','标准展台双开',2),
(5,'奚恒','非洗不可','广东深圳	',13036577114,'4964353816@qq.com','生活类','豪华展台双开',2),
(6,'堵功琰','全民好印像','广东广州',15330563024,'6655552292@qq.com','生活类','标准展台单开',1),
(7,'卞荷','丰巢科技','广东深圳',13648032569,'9572745059@qq.com','生活类','豪华展台单开',3),
(8,'濮阳雨欢','哈米科技','北京市',15297579512,'5439335748@qq.com','零售类','标准展台双开',1),
(9,'方亮','德克士','美国',18162581003,'5122799499@qq.com','餐饮类','标准展台单开',1),
(10,'喻英','快照易','广东深圳',15224091017,'638215397@qq.com','生活类','标准展台单开',2),
(11,'邱达霞','乐摇摇','广东深圳',18857925201,'8775410544@qq.com','娱乐类','标准展台双开',2),
(12,'司马菲','驿公里智能','上海市',18676298213,'4710467972@qq.com','生活类','豪华展台单开',3),
(13,'师咏露','EasyGo未来便利店','广东广州',14778055114,'2166165256@qq.com','零售类','标准展台双开',1),
(14,'宰固琪','魔力伞','上海市',18583173948,'9712046777@qq.com','生活类','豪华展台单开',2),
(15,'丁瑾斌','无人建设银行','上海市',18387714011,'1587591819@qq.com','生活类','豪华展台双开',3),
(16,'杜彪璧','EAT BOX','北京市',13071832386,'4179451336@qq.com','零售类','豪华展台单开',2),
(17,'郑萱','我抓','广东深圳',18431925197,'2522333112@qq.com','娱乐类','豪华展台双开',1),
(18,'谈毓武','乐刻运动','浙江杭州',18268232599,'897471115@qq.com','健康类','标准展台单开',2),
(19,'贡航堂','雷石','北京市',15891527817,'3125492580@qq.com','娱乐类','豪华展台单开',3),
(20,'赖健蕊','满客宝','北京市',18715419189,'140862426@qq.com','餐饮类','标准展台双开',3),
(21,'欧阳娣丹','F5未来商店','广东深圳',13264706729,'535643052@qq.com','零售类','标准展台单开',2),
(22,'许琴涛','天使之橙','上海市',13554978920,'234488988@qq.com','零售类','豪华展台双开',1),
(23,'张涛若','头等舱互联','广东深圳',17624907571,'661575494@qq.com','健康类','豪华展台单开',2),
(24,'施君','友宝','北京市',15928011403,'556161863@qq.com','零售类','标准展台单开',3),
(25,'令狐雅思','迷哒','广东广州',18131377946,'269015721@qq.com','娱乐类','豪华展台单开',2),
(26,'赫连蓓','卤豆','上海市',15554327186,'366071511@qq.com','餐饮类','标准展台双开',2),
(27,'阮苇瑗','猩便利','上海市',13015168202,'848002136@qq.com','零售类','标准展台单开',1),
(28,'胥绿','街电','广东深圳',18075458328,'681722616@qq.com','生活类','豪华展台双开',1),
(29,'符博恒','超级猩猩','广东深圳',15692834643,'916908005@qq.com','健康类','豪华展台双开',1),
(30,'尤桦秀','乐摩吧','福建福州',15359233996,'566236876@qq.com','健康类','标准展台单开',1);

insert into message(id,username,enterprise,email,message) values
(1,'曹振乐','缤果盒子','4665092357@qq.com','展场是否有额外活动？'),
(2,'上官元','友唱','3224833974@qq.com','展台能布置多少展品？'),
(3,'陆峰娜','麦当劳','2196344515@qq.com','届时会展有无工作人员？'),
(4,'东建','功夫豆','845263279@qq.com','展位如何布局安排，有无展位图？'),
(5,'奚恒','非洗不可','4964353816@qq.com','展场有无安保人员，保障商家利益不受损？'),
(6,'堵功琰','全民好印像','6655552292@qq.com','能否前提几天布置展位？'),
(7,'卞荷','丰巢科技','9572745059@qq.com','展位设计有哪些注意事项？'),
(8,'濮阳雨欢','哈米科技','5439335748@qq.com','如果当天无来，展位申请费能否退回？'),
(9,'方亮','德克士','5122799499@qq.com','展商能否获得参展群体的资源?'),
(10,'喻英','快照易','638215397@qq.com','能否告诉我一下当天展位流程安排。'),
(11,'邱达霞','乐摇摇','8775410544@qq.com','展位能容纳几个工作人员？'),
(12,'司马菲','驿公里智能','4710467972@qq.com','无'),
(13,'师咏露','EasyGo未来便利店','2166165256@qq.com','对于展商携带的物品有什么需要要求？'),
(14,'宰固琪','魔力伞','9712046777@qq.com','参观会展是否免费？'),
(15,'丁瑾斌','无人建设银行','1587591819@qq.com','会展能否保障商家财物安全？'),
(16,'杜彪璧','EAT BOX','4179451336@qq.com','无'),
(17,'郑萱','我抓','2522333112@qq.com','本次展会规模多大？'),
(18,'谈毓武','乐刻运动','897471115@qq.com','会展开始前能退款吗?'),
(19,'贡航堂','雷石','3125492580@qq.com','展位需要提前几天布置？'),
(20,'赖健蕊','满客宝','140862426@qq.com','无'),
(21,'欧阳娣丹','F5未来商店','535643052@qq.com','无'),
(22,'许琴涛','天使之橙','234488988@qq.com','展地提供水源吗？'),
(23,'张涛若','头等舱互联','661575494@qq.com','展场有无wifi，或信号好不好'),
(24,'施君','友宝','556161863@qq.com','展位规格多大？'),
(25,'令狐雅思','迷哒','269015721@qq.com','一个站台的订金时多少？'),
(26,'赫连蓓','卤豆','366071511@qq.com','无'),
(27,'阮苇瑗','猩便利','848002136@qq.com','你们的参展群体类型是？'),
(28,'胥绿','街电','681722616@qq.com','展位有多少个插座，能否私接？'),
(29,'符博恒','超级猩猩','916908005@qq.com','展场隔音效果如何？'),
(30,'尤桦秀','乐摩吧','566236876@qq.com','两个展位能否安排在一起');
