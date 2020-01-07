1.建库:create database java_web;
2.选库:use java_web;
3.设置字符编码:set names utf8;

4.创建表:
create table user(
	user_id smallint unsigned not null primary key auto_increment,
	user_account char(30) not null default '',
	user_password char(40) not null default '',
	permission_id tinyint not null default 3,
	lastlogin datetime
)engine=myisam default charset=utf8;

create table user_data(
	user_account char(30) not null default '',
	user_nick char(20) not null default '匿名',
	gender char(2) not null default '',
	tel char(20) not null default '',
	class char(20) not null  default '',
	pic_path varchar(255) not null default '/images/icon/user.png',
	key user_account(user_account)
)engine=myisam default charset=utf8;

create table teacher(
	teacher_id smallint unsigned not null primary key auto_increment,
	user_account char(30) not null default '',
	t_name char(20) not null default '',
	t_class char(20) not null default '',
	key user_account(user_account)
)engine=myisam default charset=utf8;

create table resource_tag(
	tag_id smallint unsigned not null primary key auto_increment,
	user_account char(30) not null default '',
	tag_name char(20) not null default '',
	resource_sum int not null default 0
)engine=myisam default charset=utf8;

create table resource(
	resource_id int unsigned not null primary key auto_increment,
	tag_id smallint unsigned not null default 0,
	user_account char(30) not null default '',
	resource_name char(50) not null default '请叫我资源',
	resource_type char(10) not null default '',
	resource_path varchar(255) not null default '',
	update_date datetime default current_timestamp,
	click_count int unsigned not null default 0,
	key tag_id(tag_id)
)engine=myisam default charset=utf8;

create table issue_work(
	work_id int unsigned not null primary key auto_increment,
	user_account char(30) not null default 0,
	class char(20) not null default '',
	work_title varchar(50) not null default '作业',
	work_content text,
	work_filepath varchar(255) not null default '',
	issue_date datetime default current_timestamp,
	deadline datetime,
	key user_account(user_account)
)engine=myisam default charset=utf8;

create table submit_work(
	id int unsigned not null primary key auto_increment,
	work_id int unsigned not null default 0,
	user_account char(30) not null default '',
	work_content text,
	work_filepath varchar(255) not null default '',
	submit_date datetime default current_timestamp,
	score char(10) not null default '',
	comment varchar(100) not null default '',
	key work_id(work_id)
)engine=myisam default charset=utf8;

create table study_dir(
	dirname_id smallint unsigned not null primary key auto_increment,
	user_account char(30) not null default '',
	dirname char(20) not null default '',
	article_sum smallint unsigned not null default 0,
	key dirname(dirname)
)engine=myisam default charset=utf8;

create table article(
	art_id smallint unsigned not null primary key auto_increment,
	user_account char(30) not null default '',
	dirname_id smallint unsigned not null default 0,
	art_title varchar(50) not null default '',
	art_content text,
	pubtime datetime default current_timestamp
)engine=myisam default charset=utf8;

create table forum_cat(
	cat_id smallint unsigned not null primary key auto_increment,
	cat_name char(10) not null default '',
	post_sum smallint unsigned not null default 0
)engine=myisam default charset=utf8;

create table forum_post(
	post_id int unsigned not null primary key auto_increment,
	user_account char(30) not null default '',
	post_title varchar(50) not null default '',
	cat_name char(10) not null default '',
	post_content text,
	pubtime datetime not null default current_timestamp
)engine=myisam default charset=utf8;

create table forum_comment(
	com_id int unsigned not null primary key auto_increment,
	post_id int unsigned not null default 0,
	floor_id smallint unsigned not null default 0,
	user_account char(30) not null default '',
	content text,
	pubtime datetime not null default current_timestamp,
	key post_id(post_id)
)engine=myisam default charset=utf8;

create table forum_reply(
	com_id int unsigned not null primary key auto_increment,
	post_id int unsigned not null default 0,
	floor_id smallint unsigned not null default 0,
	user_account char(30) not null default '',
	content text,
	pubtime datetime not null default current_timestamp,
	key floor_id(floor_id)
)engine=myisam default charset=utf8;

create table give_a_like(
	id int unsigned not null primary key auto_increment,
	post_id int unsigned not null default 0,
	user_account char(30) not null default '',
	key post_id(post_id)
)engine=myisam default charset=utf8;

create table pageview(
	id int unsigned not null primary key auto_increment,
	symbol char(10) not null default '',
	ip int not null default 0,
	key symbol(symbol)
)engine=myisam default charset=utf8;

create table test(
	test_id smallint unsigned not null primary key auto_increment,
	user_account char(30) not null default '',
	title varchar(100) not null default '',
	pubtime datetime default current_timestamp
)engine=myisam default charset=utf8;

create table choice_test(
	id int unsigned not null primary key auto_increment,
	test_id smallint unsigned not null default 0,
	question varchar(255) not null default '',
	A varchar(255) not null default '',
	B varchar(255) not null default '',
	C varchar(255) not null default '',
	D varchar(255) not null default '',
	answer char(5) not null default ''
)engine=myisam default charset=utf8;

create table slideshow(
	id smallint unsigned not null primary key auto_increment,
	content varchar(255) not null default '',
	pic_path varchar(255) not null default '',
	pubtime datetime default current_timestamp
)engine=myisam default charset=utf8;

create table news_cat(
	id smallint unsigned primary key auto_increment,
	cat_name char(20) not null default '',
	news_num smallint unsigned not null default 0
)engine=myisam default charset=utf8;

create table home_news(
	id int unsigned not null primary key auto_increment,
	title varchar(100) not null default '',
	cat_id smallint unsigned not null default 0,
	link varchar(255) not null default '',
	content text,
	pubtime datetime default current_timestamp
)engine=myisam default charset=utf8;

create table excellent(
	id smallint unsigned not null primary key auto_increment,
	identify tinyint unsigned not null default 1,
	name char(5) not null default '',
	pic_path varchar(255) not null default '/images/icon/user.png',
	pubtime datetime default current_timestamp
)engine=myisam default charset=utf8;

5.插入初始数据
insert into user(user_account,user_password,permission_id) values ('root','f71493380c7f1a60976558ff8fb3cf54',1);
insert into user_data(user_account,user_nick) values ('root','超级管理员');
insert into news_cat(cat_name) values ('最新资讯'),('学生优秀作品'),('站外资讯');
insert into forum_cat(cat_name) values ('公告'),('精品'),('求助'),('分享');