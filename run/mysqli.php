<?php
/*
V0.2.0
��ӭʹ��BTSnowball_PHP��ܣ�
�����ܣ�393562235@qq.com)��Ȩ����
��δ�깤
*/
if(!isset($bts_mysql_nk)){
	$bts_mysql_nk=true;
}
if($bts_mysql_nk){
$bts_link_my_i = mysqli_connect($bts_mysql_host,$bts_mysql_user,$bts_mysql_pass) or die(mysqli_connect_error());
}else{
$bts_link_my_i = mysqli_connect($bts_mysql_host,$bts_mysql_user,$bts_mysql_pass);
}
if(!$bts_link_my_i){
	$bts_link_my_i=false;
}else{
mysqli_select_db($bts_link_my_i,$bts_mysql_dbname) or die(mysqli_connect_error());
mysqli_query($bts_link_my_i,"set names 'utf8'");
}