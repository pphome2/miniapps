<?php

 #
 # Iktató
 #
 # info: main folder copyright file
 #
 #


# paramétert : 0

function i_genid($iddoc=""){
	global $I_FIRSTDOCNUM,$MA_SQL_RESULT;

	$id=1;
	$sqlc="select * from ik_param where id=$id;";
	$l=date('Y');
	$l=$l."/";
	if ((sql_run($sqlc))and(count($MA_SQL_RESULT)>0)){
		$r=$MA_SQL_RESULT[0];
		if ($r[1]<>""){
			$l=$r[1];
		}else{
			$l=$I_FIRSTDOCNUM;
		}
		if ($iddoc<>""){
			$x=explode("/",$iddoc);
			$sqlc="update ik_param set id=$id,kod=\"$x[1]\" where id=$id;";
			sql_run($sqlc);
			$l=$iddoc;
		}else{
			$n=(int)$r[1]+1;
			$s=strval($n);
			$l=date('Y');
			$l=$l."/";
			$l=$l.$s;
		}
	}else{
		$l=$l.$I_FIRSTDOCNUM;
		$sqlc="insert into ik_param (id,kod) values ($id,$I_FIRSTDOCNUM);";
		sql_run($sqlc);
	}
	return($l);
}



# paramétert : 1

function i_year($year=0){
	global $MA_SQL_RESULT;

	$id=2;
	$sqlc="select * from ik_param where id=$id;";
	if ((sql_run($sqlc))and(count($MA_SQL_RESULT)>0)){
		$r=$MA_SQL_RESULT[0];
		$y=$r[1];
		if (($year<>0)and($year<>$y)){
			$sqlc="update ik_param set id=$id,kod=\"$year\" where id=$id;";
			sql_run($sqlc);
			$y=$year;
		}
	}else{
		if ($year<>0){
			$y=$year;
		}else{
			$y=date('Y');
		}
		$sqlc="insert into ik_param (id,kod) values ($id,$y);";
		sql_run($sqlc);
	}
	return($y);
}


?>
