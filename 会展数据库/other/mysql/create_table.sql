set names utf8;

create database uee;

use uee;

create table login(
id tinyint not null primary key auto_increment,
account char(20) not null default 'guest',
password char(20) not null default '000000',
time datetime not null default current_timestamp
)engine=myisam default charset=utf8;

create table account(
id smallint unsigned not null primary key auto_increment,
username char(30) not null default '***@notexist.com',
password char(20) not null default '000000',
time datetime not null default current_timestamp
)engine=myisam default charset=utf8;

create table user(
id smallint unsigned not null primary key auto_increment,
name char(10) not null default '匿名',
gender char(1) not null default '0',
age tinyint unsigned not null default '0',
income char(20) not null default '保密',
tend char(5) not null default '暂无',
mobile_number char(15) not null default 'Null',
email char(30) not null default 'Null',
time datetime not null default current_timestamp
)engine=myisam default charset=utf8;

create table exhibitor(
id smallint unsigned not null primary key auto_increment,
username char(10) not null default '匿名',
enterprise char(20) not null default '没有填写',
address char(20) not null default '没有填写',
tel char(20) not null default '没有填写',
email char(30) not null default '没有填写',
application char(10) not null default '没有填写',
type char(10) not null default 'Null',
number tinyint not null default '0',
time datetime not null default current_timestamp
)engine=myisam default charset=utf8;

create table message(
id smallint unsigned not null primary key auto_increment,
username char(10) not null default '匿名',
enterprise char(20) not null default '没有填写',
email char(30) not null default '没有填写',
message varchar(100) not null default '无',
time datetime not null default current_timestamp
)engine=myisam default charset=utf8;