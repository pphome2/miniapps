<?php

 #
 # MiniApp - Cards plugin
 #
 # info: main folder copyright file
 #
 #

$tabledb=0;


function table_new($title){
    global $tabledb;

    $tabledb++;
    echo("<center>");
    echo("<table class='df_table_full'>");
	echo("<tr class='df_trh'>");
	for($i=0;$i<count($title);$i++){
	    if ($i==0){
            echo("<th class='df_th1'>$title[$i]</th>");
        }else{
            echo("<th class='df_th2'>$title[$i]</th>");
        }
    }
	echo("</tr>");
}


function table_close(){
    global $tabledb;

    $tabledb--;
    echo("</table>");
    echo("</center>");
}


function table_tr($data){
    echo("<tr class='df_tr'>");
	for($i=0;$i<count($data);$i++){
	    if ($i==0){
            echo("<td class='df_td1'>$data[$i]</td>");
        }else{
            echo("<td class='df_td2'>$data[$i]</td>");
        }
    }
    echo("</tr>");
}


?>
