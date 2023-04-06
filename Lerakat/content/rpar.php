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

function r_year($year=0){
	global $MA_SQL_RESULT;

	$n=0;
	$sqlc="select * from r_param where nev=$n;";
	if ((sql_run($sqlc))and(count($MA_SQL_RESULT)>0)){
		$r=$MA_SQL_RESULT[0];
		$y=$r[1];
		if (($year<>0)and($year<>$y)){
			$sqlc="update r_param set id=$r[0],nev=\"0\",ertek=\"$year\" where nev=$n;";
			sql_run($sqlc);
			$y=$year;
		}
	}else{
		if ($year<>0){
			$y=$year;
		}else{
			$y=date('Y');
		}
		$id=genid();
		$sqlc="insert into r_param (id,nev,ertek) values ($id,\"0\",$y);";
		sql_run($sqlc);
	}
	return($y);
}


?>
