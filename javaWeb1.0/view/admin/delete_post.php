<?php 
session_start();
require('../../lib/acc_user.php');
require('../../lib/init.php');

$post_id = $_GET['post_id'];

//删除帖子
$sql = "delete from forum_post where post_id = $post_id";
mQuery($sql);

//删除该贴回复 
$sql2 = "delete from forum_comment where post_id = $post_id";
mQuery($sql2);

$sql3 = "delete from forum_reply where post_id = $post_id";
mQuery($sql3);

//删除点赞
$sql4 = "delete from give_a_like where post_id = $post_id";
mQuery($sql4);

//删除浏览
$sql5 = "delete from pageview where symbol = 'post_".$post_id."'";
mQuery($sql5);

echo '删除成功';
 ?>