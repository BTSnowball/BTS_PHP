<?php
/*
欢迎使用BTSnowball_PHP框架！
林友哲（393562235@qq.com)版权所有
尚未完工
*/
$bts_main_id='main'; // In other files
if(!isset($bts_main_id)){
$bts_main_id='default';
}
switch($bts_main_id){
case 'main':
	echo 'Hello BTS_PHP';
break;
default:
    include_once('run.php');
    $bts_main_id='main';
    include('index.php');
break;
}
