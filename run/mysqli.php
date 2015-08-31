<?php
/*
欢迎使用BTSnowball_PHP框架！
林友哲（393562235@qq.com)版权所有
尚未完工
*/
if(!defined('IN_BTSPHP')) {
	exit('BTSPHP Faild!');
}
$bts_link_my_i = mysqli_connect($bts_mysql_host,$bts_mysql_user,$bts_mysql_pass) or die(mysqli_connect_error());
//mysql_select_db($mysql_dbname,$linka);
mysqli_select_db($bts_link_my_i,$bts_mysql_dbname) or die(mysqli_connect_error());
//mysql_query("set names utf8");
mysqli_query($bts_link_my_i,"set names 'utf8'");