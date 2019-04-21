1.建库:create database java_web;
2.选库:use java_web;
3.设置字符编码:set names utf8;

4.创建用户表:
create table user(
	user_id smallint unsigned not null primary key auto_increment,
	user_account char(30) not null default '',
	user_password char(40) not null default '',
	permission_id tinyint not null default 3,
	lastlogin int(10) unsigned not null default 0
)engine=myisam default charset=utf8;

create table user_data(
	user_account char(30) not null default '',
	user_nick char(30) not null default '匿名',
	gender char(10) not null default '',
	tel char(20) not null default '',
	class char(20) not null  default '',
	teacher char(10) not null default '',
	pic_path varchar(255) not null default '/images/icon/user.png',
	key user_account(user_account)
)engine=myisam default charset=utf8;

create table teacher(
	teacher_id smallint unsigned not null primary key auto_increment,
	user_account char(30) not null default '',
	t_name char(10) not null default '',
	t_class char(20) not null default '',
	key user_account(user_account)
)engine=myisam default charset=utf8;

5.创建资源表:
create table resource_tag(
	tag_id smallint unsigned not null primary key auto_increment,
	tag_name char(20) not null default '',
	resource_sum int not null default 0
)engine=myisam default charset=utf8;

create table resource(
	resource_id int unsigned not null primary key auto_increment,
	tag_id smallint unsigned not null default 0,
	user_account char(30) not null default '',
	resource_name char(50) not null default '请叫我资源',
	resource_type char(20) not null default '',
	resource_path varchar(255) not null default '',
	update_date datetime default current_timestamp,
	click_count int unsigned not null default 0,
	key tag_id(tag_id)
)engine=myisam default charset=utf8;

create table issue_work(
	work_id int unsigned not null primary key auto_increment,
	user_account char(30) not null default 0,
	class char(20) not null default '',
	work_title char(50) not null default '作业',
	work_content text,
	work_filepath char(255) not null default '',
	issue_date datetime default current_timestamp,
	deadline datetime not null default '2019-01-01 00:00:00'
)engine=myisam default charset=utf8;

create table submit_work(
	work_num int unsigned not null primary key auto_increment,
	work_id int unsigned not null default 0,
	user_account char(30) not null default '',
	work_content text,
	work_filepath char(255) not null default '',
	submit_date datetime default current_timestamp,
	score char(10) not null default '',
	comment char(100) not null default '',
	key work_id(work_id)
)engine=myisam default charset=utf8;