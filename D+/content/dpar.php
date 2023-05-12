<?php

 #
 # Dokumentum
 #
 # info: main folder copyright file
 #
 #



# paramétert : 1
function d_year($year=0){
	global $MA_SQL_RESULT,$D_COOKIE_YEAR,$MA_COOKIES;

	$ia=explode(".",$_SERVER['REMOTE_ADDR']);
	$id=$ia[3];
	$sqlc="select * from d_param where id=$id;";
	if ((sql_run($sqlc))and(count($MA_SQL_RESULT)>0)){
		$r=$MA_SQL_RESULT[0];
		$y=$r[2];
		if (($year<>0)and($year<>$y)){
			$sqlc="update d_param set id=$id,nev=$id,ertek=\"$year\" where id=$id;";
			sql_run($sqlc);
			$y=$year;
		}
	}else{
		if ($year<>0){
			$y=$year;
		}else{
			$y=date('Y');
		}
		$sqlc="insert into d_param (id,nev,ertek) values ($id,$id,\"$y\");";
		sql_run($sqlc);
	}
	return($y);
}


?>
