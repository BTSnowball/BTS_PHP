<?php
//数据安全处理函数
function bts_mysqli_VSafe($str,$bts_link_my_i,$safe=1){
	    if($safe!=0){
			switch($safe){
			case "3":
			$str=bts_sqlin_ir($str,$bts_link_my_i);
			    break;
			case "2":
			$str=bts_sqlin_ibr($str,$bts_link_my_i);
				break;
			default:
			$str=bts_sqlin_iar($str,$bts_link_my_i);
				break;
			}
			}
		return $str;
}
//数据表创建函数
function bts_mysqli_CTable($tbname,$tbper,$linki='btsnone'){
	if($linki!='btsnone'){
		$bts_link_my_i=$linki;
    }else{
		include('./config/bts_cf_mysqli.php');
		include('./run/mysqli.php');
	}
	if(isset($bts_mysql_head)&&$bts_mysql_head!=''){
		$tbname=$bts_mysql_head.$tbname;
	}
	$sql = 'CREATE TABLE '.$tbname.'('.$tbper.')';
	mysqli_query($bts_link_my_i,$sql);
}
//数据表插入函数
function bts_mysqli_insert($tbname,$key=null,$values,$safe=1,$linki='btsnone'){
	if($linki!='btsnone'){
		$bts_link_my_i=$linki;
    }else{
		include('./config/bts_cf_mysqli.php');
		include('./run/mysqli.php');
	}
	if($safe!=0){
		$tbname=bts_mysqli_VSafe($tbname,$bts_link_my_i,3);
	}
	if(isset($bts_mysql_head)&&$bts_mysql_head!=''){
		$tbname=$bts_mysql_head.$tbname;
	}
	$sql='insert into '.$tbname;
	if($key!=null){
		$sql=$sql.'(';
	if(is_array($key)){
		foreach($key as $keya){
			$keya=bts_mysqli_VSafe($keya,$bts_link_my_i,$safe);
			$sql=$sql.$keya.',';
		}
		$sql=substr($sql,0,-1);
		$sql=$sql.") values('";
	}else{
		$key=bts_mysqli_VSafe($key,$bts_link_my_i,$safe);
		$sql=$sql.$key.") values('";
	}
	}else{
		$sql=$sql." values('";
	}
	if(is_array($values)){
		foreach($values as $valuesa){
			$valuesa=bts_mysqli_VSafe($valuesa,$bts_link_my_i,$safe);
			$sql=$sql.$valuesa."','";
		}
		$sql=substr($sql,0,-2);
		$sql=$sql.')';
	}else{
		$values=bts_mysqli_VSafe($values,$bts_link_my_i,$safe);
		$sql=$sql.$values."')";
	}
	echo $sql;
	mysqli_query($bts_link_my_i,$sql);
}
//数据删除函数
function bts_mysqli_delete($tbname,$key,$values,$safe=1,$linki='btsnone'){
	if($linki!='btsnone'){
		$bts_link_my_i=$linki;
    }else{
		include('./config/bts_cf_mysqli.php');
		include('./run/mysqli.php');
	}
	if($safe!=0){
		$tbname=bts_mysqli_VSafe($tbname,$bts_link_my_i,3);
	}
	if(isset($bts_mysql_head)&&$bts_mysql_head!=''){
		$tbname=$bts_mysql_head.$tbname;
	}
	$sql='DELETE FROM '.$tbname.' where';
	$dosle=2;
	if(is_array($key)){
			$dosle=1;
	}else{
		$key=bts_mysqli_VSafe($key,$bts_link_my_i,$safe);
		$sql=$sql.' '.$key."='";
	}
	if(is_array($values)){
		foreach($values as $valuesa){
			$valuesa=bts_mysqli_VSafe($valuesa,$bts_link_my_i,$safe);
			$valuesas[]=$valuesa;
			$dosle=1;
		}
	}else{
		$values=bts_mysqli_VSafe($values,$bts_link_my_i,$safe);
		$sql=$sql.$values."' ";
	}
	if($dosle==1){
		$dosle=0;
		foreach($key as $keya){
			$keya=bts_mysqli_VSafe($keya,$bts_link_my_i,$safe);
			$sql=$sql.' '.$keya."='".$valuesas["$dosle"]."' AND";
			$dosle=$dosle+1;
		}
		$sql=substr($sql,0,-3);
	}
	mysqli_query($bts_link_my_i,$sql);
}
//数据库查询
function bts_mysqli_select($tbname,$key,$values,$safe=1,$linki='btsnone',$sk='*',$lima=0,$limb=0,$order=null,$pl=1){
	if($linki!='btsnone'){
		$bts_link_my_i=$linki;
    }else{
		include('./config/bts_cf_mysqli.php');
		include('./run/mysqli.php');
	}
	if($safe!=0){
		$tbname=bts_mysqli_VSafe($tbname,$bts_link_my_i,3);
	}
	if(isset($bts_mysql_head)&&$bts_mysql_head!=''){
		$tbname=$bts_mysql_head.$tbname;
	}
	if($sk!='*'){
		$sk=bts_mysqli_VSafe($sk,$bts_link_my_i,$safe);
	}
	$sql='SELECT '.$sk.' FROM '.$tbname.' where';
	$dosle=2;
	if(is_array($key)){
			$dosle=1;
	}else{
		$key=bts_mysqli_VSafe($key,$bts_link_my_i,$safe);
		$sql=$sql.' '.$key."='";
	}
	if(is_array($values)){
		foreach($values as $valuesa){
			$valuesa=bts_mysqli_VSafe($valuesa,$bts_link_my_i,$safe);
			$valuesas[]=$valuesa;
			$dosle=1;
		}
	}else{
		$values=bts_mysqli_VSafe($values,$bts_link_my_i,$safe);
		$sql=$sql.$values."' ";
	}
	if($dosle==1){
		$dosle=0;
		foreach($key as $keya){
			$keya=bts_mysqli_VSafe($keya,$bts_link_my_i,$safe);
			$sql=$sql.' '.$keya."='".$valuesas["$dosle"]."' AND";
			$dosle=$dosle+1;
		}
		$sql=substr($sql,0,-3);
	}
	if($order!=null){
		$order=bts_mysqli_VSafe($order,$bts_link_my_i,$safe);
		$sql=$sql.' ORDER BY'.$tbname.$order.' ';
		if($pl==1){
			$pl='ASC';
		}else{
			$pl='DESC';
		}
		$sql=$sql.$pl;
	}
	if($limb!=0){
		$limb=intval($limb);
		$lima=intval($lima);
		$sql=$sql.' LIMIT '.$lima.','.$limb;
	}
	$res=mysqli_query($bts_link_my_i,$sql);
	return $res;
}
//num
function bts_mysqli_nr($res){
	if($res==""){
		return 0;
	}
	$res=mysqli_num_rows($res);
	return $res;
}
function bts_mysqli_nf($res){
	if($res==""){
		return 0;
	}
	$res=mysql_num_fields($res);
	return $res;
}
//结果
function bts_mysqli_fo($res,$key=null){
	if($info=mysqli_fetch_object($res)){
	if($key!=null){
		$res=$info->$key;
		return $res;
	}
	return $info;
	}else{
	return False;
	}
}
function bts_mysqli_fa($res,$key=null){
	if($info=mysqli_fetch_array($res)){
	if($key!=null){
		$res=$info["$key"];
		return $res;
	}
	return $info;
	}else{
	return False;
	}
}
function bts_mysqli_fr($res,$key=null){
	if($info=mysqli_fetch_row($res)){
	if($key!=null){
		$res=$info["$key"];
		return $res;
	}
	return $info;
	}else{
	return False;
	}
}
function bts_mysqli_fas($res,$key=null){
	if($info=mysqli_fetch_assoc($res)){
	if($key!=null){
		$res=$info["$key"];
		return $res;
	}
	return $info;
	}else{
	return False;
	}
}
//数据更新
function bts_mysqli_update($tbname,$key,$values,$wkey,$wvalues,$safe=1,$linki='btsnone'){
	if($linki!='btsnone'){
		$bts_link_my_i=$linki;
    }else{
		include('./config/bts_cf_mysqli.php');
		include('./run/mysqli.php');
	}
	if($safe!=0){
		$tbname=bts_mysqli_VSafe($tbname,$bts_link_my_i,3);
	}
	if(isset($bts_mysql_head)&&$bts_mysql_head!=''){
		$tbname=$bts_mysql_head.$tbname;
	}
	$sql='update '.$tbname.' set';
	$dosle=2;
	if(is_array($key)){
			$dosle=1;
	}else{
		$key=bts_mysqli_VSafe($key,$bts_link_my_i,$safe);
		$sql=$sql.' '.$key."='";
	}
	if(is_array($values)){
		foreach($values as $valuesa){
			$valuesa=bts_mysqli_VSafe($valuesa,$bts_link_my_i,$safe);
			$valuesas[]=$valuesa;
			$dosle=1;
		}
	}else{
		$values=bts_mysqli_VSafe($values,$bts_link_my_i,$safe);
		$sql=$sql.$values."' ";
	}
	if($dosle==1){
		$dosle=0;
		foreach($key as $keya){
			$keya=bts_mysqli_VSafe($keya,$bts_link_my_i,$safe);
			$sql=$sql.' '.$keya."='".$valuesas["$dosle"]."',";
			$dosle=$dosle+1;
		}
		$sql=substr($sql,0,-1);
	}
	$sql=$sql.'where ';
	$dosle=2;
	if(is_array($wkey)){
			$dosle=1;
	}else{
		$wkey=bts_mysqli_VSafe($wkey,$bts_link_my_i,$safe);
		$sql=$sql.' '.$wkey."='";
	}
	if(is_array($wvalues)){
		foreach($wvalues as $wvaluesa){
			$wvaluesa=bts_mysqli_VSafe($wvaluesa,$bts_link_my_i,$safe);
			$wvaluesas[]=$wvaluesa;
			$dosle=1;
		}
	}else{
		$wvalues=bts_mysqli_VSafe($wvalues,$bts_link_my_i,$safe);
		$sql=$sql.$wvalues."' ";
	}
	if($dosle==1){
		$dosle=0;
		foreach($wkey as $wkeya){
			$wkeya=bts_mysqli_VSafe($wkeya,$bts_link_my_i,$safe);
			$sql=$sql.' '.$wkeya."='".$wvaluesas["$dosle"]."' AND";
			$dosle=$dosle+1;
		}
		$sql=substr($sql,0,-3);
	}
	mysqli_query($bts_link_my_i,$sql);
}
//STMT execute
function bts_mysqli_se($stmt){
	mysqli_stmt_execute($stmt);
}
//STMT CLOSE
function bts_mysqli_sc($stmt){
	mysqli_stmt_close($stmt);
}
//STMT BINDP
function bts_mysqli_bps($str){
	$typ=gettype($str);
	switch($typ){
		case 'integer':
			return 'i';
		break;
		case 'double':
			return 'd';
		break;
		case 'boolean':
			return 'b';
		break;
		default:
			return 's';
		break;
	}
	return false;
}
function bts_mysqli_bpc($stmtname,$vars,$vs=null){
if(!is_array($vars)){
	if($vs==null){
		$vs=bts_mysqli_bps($vars);
	}
	$bpcode='mysqli_stmt_bind_param('.$stmtname.','."'".$vs."'".','.$vars.');';
}else{
	if($vs==null){
		$vs='';
		$varslist='';
		foreach($vars as $varsa){
		$vs=$vs.bts_mysqli_bps($varsa);
		$varslist=$varslist.$varsa.',';
		}
		$varslist=substr($varslist,0,-1);
		$bpcode='mysqli_stmt_bind_param('.$stmtname.','."'".$vs."'".','.$varslist.');';
	}
}
return $bpcode;
}
function bts_mysqli_sg($stmt,$fa='none'){
	$result = mysqli_stmt_get_result($stmt);
	if($fa!='none'){
		switch($fa){
			case "1"or'fa':
				$info=bts_mysqli_fa($result);
			return $info;
			break;
			case "2"or'fo':
				$info=bts_mysqli_fo($result);
			return $info;
			break;
			case "3"or'fr':
				$info=bts_mysqli_fr($result);
			return $info;
			break;
			case "4"or'fas':
				$info=bts_mysqli_fas($result);
			return $info;
			break;
			default:
			break;
		}
	}
	return $result;
}
//SMTM数据表插入函数
function bts_mysqli_sinsert($tbname,$key=null,$safe=3,$linki='btsnone'){
	if($linki!='btsnone'){
		$bts_link_my_i=$linki;
    }else{
		include('./config/bts_cf_mysqli.php');
		include('./run/mysqli.php');
	}
	if($safe!=0){
		$tbname=bts_mysqli_VSafe($tbname,$bts_link_my_i,3);
	}
	if(isset($bts_mysql_head)&&$bts_mysql_head!=''){
		$tbname=$bts_mysql_head.$tbname;
	}
	$sql='insert into '.$tbname;
	if($key!=null){
		$sql=$sql.'(';
	if(is_array($key)){
		foreach($key as $keya){
			$keya=bts_mysqli_VSafe($keya,$bts_link_my_i,$safe);
			$sql=$sql.$keya.',';
		}
		$sql=substr($sql,0,-1);
		$sql=$sql.") values(";
	}else{
		$key=bts_mysqli_VSafe($key,$bts_link_my_i,$safe);
		$sql=$sql.$key.") values(";
	}
	}else{
		$sql=$sql." values(";
	}
	if(is_array($key)){
		foreach($key as $keya){
			$keya='?';
			$sql=$sql.$keya.",";
		}
		$sql=substr($sql,0,-1);
		$sql=$sql.')';
	}else{
		$sql=$sql."?)";
	}
	$stmt = mysqli_prepare($bts_link_my_i,$sql);
	return $stmt;
}
//查询
function bts_mysqli_sselect($tbname,$key=null,$safe=1,$linki='btsnone',$sk='*',$lima=0,$limb=0,$order=null,$pl=1){
	if($linki!='btsnone'){
		$bts_link_my_i=$linki;
    }else{
		include('./config/bts_cf_mysqli.php');
		include('./run/mysqli.php');
	}
	if($safe!=0){
		$tbname=bts_mysqli_VSafe($tbname,$bts_link_my_i,3);
	}
	if(isset($bts_mysql_head)&&$bts_mysql_head!=''){
		$tbname=$bts_mysql_head.$tbname;
	}
	if($sk!='*'){
		$sk=bts_mysqli_VSafe($sk,$bts_link_my_i,$safe);
	}
	$sql='SELECT '.$sk.' FROM '.$tbname.' ';
	if($key!=null){
	$sql=$sql.'where';
	$dosle=2;
	if(is_array($key)){
			$dosle=1;
	}else{
		$key=bts_mysqli_VSafe($key,$bts_link_my_i,$safe);
		$sql=$sql.' '.$key."='";
	}
	}
	if($dosle==1){
		$dosle=0;
		foreach($key as $keya){
			$keya=bts_mysqli_VSafe($keya,$bts_link_my_i,$safe);
			$sql=$sql.' '.$keya."=? AND";
			$dosle=$dosle+1;
		}
		$sql=substr($sql,0,-3);
	}
	if($order!=null){
		$order=bts_mysqli_VSafe($order,$bts_link_my_i,$safe);
		$sql=$sql.' ORDER BY'.$tbname.$order.' ';
		if($pl==1){
			$pl='ASC';
		}else{
			$pl='DESC';
		}
		$sql=$sql.$pl;
	}
	if($limb!=0){
		$limb=intval($limb);
		$lima=intval($lima);
		$sql=$sql.' LIMIT '.$lima.','.$limb;
	}
	$stmt = mysqli_prepare($bts_link_my_i,$sql);
	return $stmt;
}
