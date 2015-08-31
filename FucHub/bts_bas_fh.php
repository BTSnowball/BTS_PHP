<?php
/*
欢迎使用BTSnowball_PHP框架！
林友哲（393562235@qq.com)版权所有
尚未完工
*/
//获取操作系统信息
function bts_bas_getOs(){
   if(!empty($_SERVER['HTTP_USER_AGENT'])){
    $getOS = $_SERVER['HTTP_USER_AGENT'];
      if (preg_match('/win/i',$getOS)) {
     $OS = 'Windows';
    }elseif (preg_match('/mac/i',$getOSS)) {
     $getOS = 'MAC';
    }elseif (preg_match('/linux/i',$getOS)) {
     $getOS = 'Linux';
    }elseif (preg_match('/unix/i',$getOS)) {
     $getOS = 'Unix';
    }elseif (preg_match('/bsd/i',$getOS)) {
     $getOS = 'BSD';
    }else {
     $getOS = 'UnKnow';
    }
          return $getOS;  
   }else{return false;}   
}
//获取浏览器信息
function bts_bas_getBrowser(){
$agent=$_SERVER["HTTP_USER_AGENT"];
if(strpos($agent,'MSIE')!==false || strpos($agent,'rv:11.0')) //ie11判断
return "ie";
else if(strpos($agent,'Firefox')!==false)
return "firefox";
else if(strpos($agent,'Chrome')!==false)
return "chrome";
else if(strpos($agent,'Opera')!==false)
return 'opera';
else if((strpos($agent,'Chrome')==false)&&strpos($agent,'Safari')!==false)
return 'safari';
else
return 'unknown';
}
//获取语言
function bts_bas_getlang(){
$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 4);
if (preg_match("/zh-c/i", $lang)) 
return "简体中文"; 
else if (preg_match("/zh/i", $lang)) 
return "繁體中文"; 
else if (preg_match("/en/i", $lang)) 
return "English"; 
else if (preg_match("/fr/i", $lang)) 
return "French"; 
else if (preg_match("/de/i", $lang)) 
return "German"; 
else if (preg_match("/jp/i", $lang)) 
return "Japanese"; 
else if (preg_match("/ko/i", $lang)) 
return "Korean"; 
else if (preg_match("/es/i", $lang)) 
return "Spanish"; 
else if (preg_match("/sv/i", $lang)) 
return "Swedish"; 
else return $_SERVER["HTTP_ACCEPT_LANGUAGE"];
}
//获取IP地址
function bts_bas_getIP(){ 
if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown")) 
$ip = getenv("HTTP_CLIENT_IP"); 
else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown")) 
$ip = getenv("HTTP_X_FORWARDED_FOR"); 
else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown")) 
$ip = getenv("REMOTE_ADDR"); 
else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown")) 
$ip = $_SERVER['REMOTE_ADDR']; 
else 
$ip = 'unknown'; 
return($ip); 
}
//截出域名信息
function bts_bas_getdomain($url) { 
$host = strtolower ( $url ); 
if (strpos ( $host, '/' ) !== false) { 
$parse = @parse_url ( $host ); 
$host = $parse ['host']; 
} 
$topleveldomaindb = array ('com', 'edu', 'gov', 'int', 'mil', 'net', 'org', 'biz', 'info', 'pro', 'name', 'museum', 'coop', 'aero', 'xxx', 'idv', 'mobi', 'cc', 'me','in','io','gg','co' ); 
$str = ''; 
foreach ( $topleveldomaindb as $v ) { 
$str .= ($str ? '|' : '') . $v; 
} 

$matchstr = "[^\.]+\.(?:(" . $str . ")|\w{2}|((" . $str . ")\.\w{2}))$"; 
if (preg_match ( "/" . $matchstr . "/ies", $host, $matchs )) { 
$domain = $matchs ['0']; 
} else { 
$domain = $host; 
} 
return $domain; 
}