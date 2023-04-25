<?php

 #
 # Raktár
 #
 # info: main folder copyright file
 #
 #


function r_genid(){
	$id=date('YmdHis');
	return($id);
}


# paramétert : 0

function r_storeage($store=0){
	global $MA_SQL_RESULT;

	$ia=$_SERVER['REMOTE_ADDR'];
	$ia2=explode(".",$ia);
	$id=r_genid();
	$sqlc="select * from r_param where nev=\"$ia\";";
	if ((sql_run($sqlc))and(count($MA_SQL_RESULT)>0)){
		$r=$MA_SQL_RESULT[0];
		$s=$r[2];
		if (($store<>0)and($store<>$s)){
			$sqlc="update r_param set id=$r[0],nev=\"$r[1]\",ertek=\"$store\" where id=$r[0]";
			sql_run($sqlc);
		}else{
			$store=$r[2];
		}
	}else{
		$sqlc="insert into r_param (id,nev,ertek) values ($id,\"$ia\",\"$store\");";
		sql_run($sqlc);
	}
	return($store);
}


?>
