create database shop;

create table cat (
 cat_id smallint unsigned auto_increment primary key,
 cat_name varchar(90) not null default '',
 intro varchar(255) not null default '',
 parent_id smallint unsigned
 )engine myisam charset utf8;

create table goods (
  goods_id mediumint(8) unsigned primary key auto_increment,
  goods_sn char(15) not null default '',
  cat_id smallint(5) unsigned not null default '0',
  brand_id smallint(5) unsigned not null default '0',
  goods_name varchar(120) not null default '',
  shop_price decimal(10,2) unsigned not null default '0.00',
  market_price decimal(10,2) unsigned not null default '0.00',
  goods_number smallint(5) unsigned not null default '0',
  click_count int(10) unsigned not null default '0',
  goods_weight decimal(5,3) unsigned not null default '0.000',
  goods_brief varchar(255) not null default '',
  goods_desc varchar(255) not null default '',
  thumb_img varchar(255) not null default '',
  goods_img varchar(255) not null default '',
  ori_img varchar(255) not null default '',
  is_on_sale tinyint not null default 0,
  is_delete tinyint not null default 0,
  is_best tinyint not null default 0,
  is_new tinyint not null default 0,
  is_hot tinyint not null default 0,
  add_time int unsigned not null default 0,
  last_update int unsigned not null default 0
) engine=myisam default charset=utf8;

create table user (
user_id int unsigned auto_increment primary key,
username char(30) not null default '',
email char(30) not null default '',
password char(32) not null default '',
salt char(8) not null default '',
key username(username),
key email(email)
) engine myisam charset utf8;

create table ordinfo (
ordinfo_id int unsigned primary key auto_increment, ord_sn char(12) not null default '',
user_id int not null default 0,
xm char(10) not null default '',
mobile char(11),
address varchar(30),
paytype tinyint not null default 1, #1在线,2是否到付 paystatus tinyint not null default 0,#0未支付,1已付款 money decimal(9,2),
note varchar(20) not null default '',
ordtime int unsigned not null default 0,
key user_id(user_id)
)engine myisam charset utf8;

create table ordgoods (
ordgoods_id int primary key auto_increment, 
ordinfo_id int not null default 0,
goods_id int not null default 0,
goods_name varchar(20),
shop_price decimal(7,2),
goods_num smallint unsigned not null default 0,
   key ordinfo_id(ordinfo_id)
)engine myisam charset utf8;

create table comment (
comment_id int unsigned auto_increment primary key,
goods_id int unsigned not null default 0,
user_id int unsigned not null default 0,
email char(30) not null default '',
content varchar(140) not null default '',
pubtime int unsigned not null default 0
) engine myisam charset utf8;