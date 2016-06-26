<?php
/*
V0.2.0
欢迎使用BTSnowball_PHP框架！
林友哲（393562235@qq.com)版权所有
尚未完工
*/
//html标签删除函数
function bts_str_delhtml($str){
    $html_string = array('&amp;', '&nbsp;', '"', "'", '<', '>', '\t', '\r');
    $html_clear = array('&', ' ', '&#39;', '&quot;', '&lt;', '&gt;', '&nbsp; &nbsp; ', '');
    $js_string = array('/<script(.*)<\/script>/isU');
    $js_clear = array('');
    $frame_string = array('/<frame(.*)>/isU', '/<\/fram(.*)>/isU', '/<iframe(.*)>/isU', '/<\/ifram(.*)>/isU',);
    $frame_clear = array('', '', '', '');
    $style_string = array('/<style(.*)<\/style>/isU', '/<link(.*)>/isU', '/<\/link>/isU');
    $style_clear = array('', '', '');
    $str = trim($str);
    //过滤字符串
    $str = str_replace($html_string, $html_clear, $str);
    //过滤JS
    $str = preg_replace($js_string, $js_clear, $str);
    //过滤ifram
    $str = preg_replace($frame_string, $frame_clear, $str);
    //过滤style
    $str = preg_replace($style_string, $style_clear, $str);
    return $str;
}
function bts_str_delhtmlb($str){
	$str=strip_tags($str);
	return $str;
}
//SQL诸如防御函数
function bts_sqlin_a($str){
   $str = str_replace('and','',$str);
   $str = str_replace('execute','',$str);
   $str = str_replace('update','',$str);
   $str = str_replace('count','',$str);
   $str = str_replace('chr','',$str);
   $str = str_replace('mid','',$str);
   $str = str_replace('master','',$str);
   $str = str_replace('truncate','',$str);
   $str = str_replace('char','',$str);
   $str = str_replace('declare','',$str);
   $str = str_replace('select','',$str);
   $str = str_replace('create','',$str);
   $str = str_replace('delete','',$str);
   $str = str_replace('insert','',$str);
   $str = str_replace("'",'',$str);
   $str = str_replace('"','',$str);
   $str = str_replace(' ','',$str);
   $str = str_replace('or','',$str);
   $str = str_replace('=','',$str);
   $str = str_replace('%20','',$str);
   $str = str_replace('*','',$str);
   $str = str_replace('_','\_',$str);
   $str = str_replace('%','\%',$str);
   $str = str_replace('0xbf27', '%BF%27', $str);
   $str = str_replace('0xbf5c', '%BF%5c', $str);
   $str = str_replace('%2527','',$str);
   return $str;
}
function bts_sqlin_b($str){
   $str = str_replace('and','&#97;nd',$str);
   $str = str_replace('execute','&#101;xecute',$str);
   $str = str_replace('update','&#117;pdate',$str);
   $str = str_replace('count','&#99;ount',$str);
   $str = str_replace('chr','&#99;hr',$str);
   $str = str_replace('mid','&#109;id',$str);
   $str = str_replace('master','&#109;aster',$str);
   $str = str_replace('truncate','&#116;runcate',$str);
   $str = str_replace('char','&#99;har',$str);
   $str = str_replace('declare','&#100;eclare',$str);
   $str = str_replace('select','&#115;elect',$str);
   $str = str_replace('create','&#99;reate',$str);
   $str = str_replace('delete','&#100;elete',$str);
   $str = str_replace('insert','&#105;nsert',$str);
   $str = str_replace("'",'&#39;',$str);
   $str = str_replace('"','&#34;',$str);
   $str = str_replace('%20','',$str);
   $str = str_replace('*','',$str);
   $str = str_replace('_','\_',$str);
   $str = str_replace('%','\%',$str);
   $str = str_replace('0xbf27', '%BF%27', $str);
   $str = str_replace('0xbf5c', '%BF%5c', $str);
   $str = str_replace('%2527','',$str);
   return $str;
}
function bts_sqlin_c($str){
    if (!get_magic_quotes_gpc()) {      
    return addslashes($string);      
    }      
    return $string;      
}
function bts_sqlin_r($str){    
    return stripslashes($string);          
}
function bts_sqlin_fzra($str,$bm='UTF-8') {   
$encode = mb_detect_encoding( $str, array('ASCII','UTF-8','GB2312','GBK','BIG5','JIS'));
if ( !$encode =='UTF-8' ){
if($encode!=FALSE){
$str = iconv('UTF-8',$encode,$str);
$str = iconv($encode,'UTF-8',$str);
}else{
	if($bm!='UTF-8'){
       $str = iconv('UTF-8',$bm,$str);
       $str = iconv($bm,'UTF-8',$str);
	}
}
}
$str=bts_sqlin_a($str);
return $str;
}
function bts_sqlin_fzrb($str,$bm='UTF-8') {   //简单粗暴,但如果不在判定范围内必须指定。请各位开发者注意
$encode = mb_detect_encoding( $str, array('ASCII','UTF-8','GB2312','GBK','BIG5','JIS'));
if ( !$encode =='UTF-8' ){
if($encode!=FALSE){
$str = iconv('UTF-8',$encode,$str);
$str = iconv($encode,'UTF-8',$str);
}else{
	if($bm!='UTF-8'){
       $str = iconv('UTF-8',$bm,$str);
       $str = iconv($bm,'UTF-8',$str);
	}
}
}
$str=bts_sqlin_b($str);
return $str;
}
function bts_sqlin_iar($str,$linki='btsnone'){ 
	if($linki!='btsnone'){
		$bts_link_my_i=$linki;
    }else{
		include('./config/bts_cf_mysqli.php');
		include('./run/mysqli.php');
	}
	$str=bts_sqlin_fzra($str);
	$str=mysqli_real_escape_string($linki,$str);
	return $str;
}
function bts_sqlin_ibr($str,$linki='btsnone'){ 
	if($linki!='btsnone'){
		$bts_link_my_i=$linki;
    }else{
		include('./config/bts_cf_mysqli.php');
		include('./run/mysqli.php');
	}
	$str=bts_sqlin_fzrb($str);
	$str=mysqli_real_escape_string($linki,$str);
	return $str;
}
function bts_sqlin_ir($str,$linki='btsnone'){ 
	if($linki!='btsnone'){
		$bts_link_my_i=$linki;
    }else{
		include('./config/bts_cf_mysqli.php');
		include('./run/mysqli.php');
	}
	$str = str_replace('0xbf27', '%BF%27', $str);
    $str = str_replace('0xbf5c', '%BF%5c', $str);
    $str = str_replace('%2527','',$str);
	$str=mysqli_real_escape_string($linki,$str);
	return $str;
}
//变量类型判定函数
function bts_str_vpd($str){
	$typ=gettype($str);
	return $typ;
}
//字符串类型转换函数
function bts_str_2utf($str,$typ=null)
{
if($typ==null){
$encode = mb_detect_encoding( $str, array('ASCII','UTF-8','GB2312','GBK','BIG5'));
}else{
$encode=$typ;
}
if ( !$encode =='UTF-8' ){
$str = iconv($encode,'UTF-8',$str);
}
return $str;
}
function bts_str_2gbk($str,$typ=null)
{
if($typ==null){ 
$encode = mb_detect_encoding( $str, array('ASCII','UTF-8','GB2312','GBK','BIG5'));
}else{
$encode=$typ;
}
if ( !$encode =='GBK' ){
$str = iconv($encode,'GBK',$str);
}
return $str;
}
function bts_str_GB2312($str,$typ=null)
{
if($typ==null){ 
$encode = mb_detect_encoding( $str, array('ASCII','UTF-8','GB2312','GBK','BIG5'));
}else{
$encode=$typ;
}
if ( !$encode =='GB2312' ){
$str = iconv($encode,'GB2312',$str);
}
return $str;
}
function bts_str_2typ($ttyp,$typ=null)
{
if($typ==null){ 
$encode = mb_detect_encoding( $str, array('ASCII','UTF-8','GB2312','GBK','BIG5'));
}else{
$encode=$typ;
}
if ( !$encode == $ttyp ){
$str = iconv($encode,$ttyp,$str);
}
return $str;
}
function bts_str_FenGe($str,$ws,$fg='|')
{
	$hello = explode($fg,$str);
	return $hello[$ws];
}
function  bts_str_FenGeS($str,$fg='|')
{
	$hello = explode($fg,$str);
	return $hello;
}
function bts_is_not_json($str){
	return is_null(json_decode($str));
}
function bts_is_json($str){  
    if(is_null(json_decode($str))){
		return false;
	}else{
		return true;
	}
}
function bts_is_sjson($str) { 
 $str=json_decode($str);
 return (json_last_error() == JSON_ERROR_NONE);
}
function bts_str_sub($str,$le,$start=0,$encoding="utf8"){
	if(function_exists("mb_string")){
		$res=mb_substr($str,$start,$le,$encoding);
	}else{
		$res=substr($str,$start,$le);
	}
	return $res;
}
function bts_str_iswhat($value){
	if(is_int($value)){
		return 'i';
	}elseif(is_double($value)){
		return 'd';
	}else{
		return 's';
	}
}