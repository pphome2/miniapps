<?php

#
# File list for download from directory (insert iframe to webpage)
# (show text for files)
#
# 2019. WSWDTeam GPLv3
#
#


    $DF_LANG=array('Név','Dátum','Méret');
    $DF_DOWNLOAD_TEXT='Letöltés';
    $DF_FILEEXT=array('jpg','php');

    $DF_DIR='./dir';
    $DF_TEXTFILE_EXT='.txt';

    $DF_LINK_TARGET_NEW_WINDOW=false;
    $table=false;

?>

<!DOCTYPE HTM>
<html>
    <head>
	<title>DownloadFile</title>
	<meta charset="utf-8" />
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="shortcut icon" href="favicon.png">
	<link rel="icon" type="image/x-icon" href="favicon.png">
    </head>
<body>



<style type="text/css">
  .df_table {
    width:90%;
  }

  .df_trh {
    background-color:lightblue;
  }

  .df_th1 {
    padding:5px;
    color:#a7a8a8;
    width:60%;
  }

  .df_th2 {
    padding:5px;
    color:#a7a8a8;
    width:20%;
  }

  .df_tr:nth-child(even){
    background-color:white;
  }

  .df_tr:nth-child(odd) {
    background-color:#f2f2f2;
  }

  .df_td {
    color:#808080;
    text-align:left;
    padding:10px;
  }

  .df_td2 {
    color:#808080;
    text-align:center;
  }

  .df_tds {
    color:red;
  }

  .df_tda {
    text-decoration:none;
    color:#808080;
  }

  .df_tda2 {
    text-decoration:none;
    color:red;
  }

  .df_table {
    width:90%;
  }

  .df_trh {
    background-color:lightblue;
  }

  .df_th1 {
    padding:5px;
    color:#a7a8a8;
    width:60%;
  }

  .df_th2 {
    padding:5px;
    color:#a7a8a8;
    width:20%;
  }

  .df_tr:nth-child(even){
    background-color:white;
  }

  .df_tr:nth-child(odd) {
    background-color:#f2f2f2;
  }

  .df_td {
    color:#808080;
    text-align:left;
    padding:10px;
  }

  .df_td2 {
    color:#808080;
    text-align:center;
  }

  .df_tds {
    color:red;
  }

  .df_tda {
    text-decoration:none;
    color:#808080;
  }

  .df_tda2 {
    text-decoration:none;
    color:red;
  }


</style>


<?php

function formatBytes($size, $precision=2){
    $base=log($size, 1024);
    $suffixes=array('', 'K', 'M', 'G', 'T');
    return round(pow(1024,$base-floor($base)),$precision).' '.$suffixes[floor($base)];
}

function filetable($dir){
    global $DF_FILEEXT,$DF_LANG,$DF_TEXTFILE_EXT,$DF_DOWNLOAD_TEXT,$table;

    $files=scandir($dir);
    asort($files);
    $fdb=0;
    foreach ($files as $entry) {
        if ($entry!="." && $entry!="..") {
			$dirn=$dir.'/'.$entry;
			if (is_dir($dirn)){
				echo("<br /><br />");
				echo("<b>$entry</b>");
				echo("<br /><br />");
				echo("<center>");
				echo("<table class='df_table'>");
				echo("<tr class='df_trh'>");
				echo("<th class='df_th1'>$DF_LANG[0]</th>");
				echo("<th class='df_th2'>$DF_LANG[1]</th>");
				echo("<th class='df_th2'>$DF_LANG[2]</th>");
				echo("</tr>");
				$table=true;
				filetable($dirn);
				echo("</table>");
				echo("</center>");
				$table=false;
			}else{
				if (!$table){
					$dn=explode('/',$dir);
					$s=count($dn)-1;
					$dirx=$dn[$s];
					echo("<br /><br />");
					echo("<b>$dirx</b>");
					echo("<br /><br />");
					echo("<center>");
					echo("<table class='df_table'>");
					echo("<tr class='df_trh'>");
					echo("<th class='df_th1'>$DF_LANG[0]</th>");
					echo("<th class='df_th2'>$DF_LANG[1]</th>");
					echo("<th class='df_th2'>$DF_LANG[2]</th>");
					echo("</tr>");
					$table=true;
				}
			}
            $fileext=explode('.',$entry);
            $fileext_name=$fileext[count($fileext)-1];
            $fileext_name2='.'.$fileext_name;
            if ((in_array($fileext_name, $DF_FILEEXT))or(in_array($fileext_name2, $DF_FILEEXT))){
                echo("<tr class='df_tr'>");
                $fileext_name=strtoupper($fileext_name);
                echo("<td class='df_td'><span class='df_tds'>[$fileext_name]</span> ");
                echo("<a href='$dir/$entry' target='$target' class='df_tda'>$entry</a>");
                echo(" ");
                #echo("<br />");
                #echo("<br />");
                #$filetext=$dir.'/'.$entry.$DF_TEXTFILE_EXT;
                #if (file_exists($filetext)){
                #    echo(file_get_contents($filetext)."<br />");
                #    echo("<br />");
                #    echo("<br />");
                #}
                echo("<a href='$dir/$entry' download class='df_tda2' onclick='delrow(this);'>$DF_DOWNLOAD_TEXT</a>");
                echo("<br />");
                echo("<br />");
                echo("</td>");
                $m=filectime($dir.'/'.$entry);
                $m=gmdate("Y.m.d", $m);
                echo("<td class='df_td2'>$m</td>");
                $m=filesize($dir.'/'.$entry);
                $m=formatBytes($m);
                echo("<td class='df_td2'>$m</td>");
                echo("</tr>");
            }
        }
    }
            if ($table){
				echo("</table>");
				echo("</center>");
			}

}


if ($DF_LINK_TARGET_NEW_WINDOW){
    $target="_blank";
}else{
    $target="";
}

echo("<br /><br />");

filetable($DF_DIR);

echo("<br /><br />");

?>

<script>
    function delrow(obj){
	obj2=obj.parentNode;
	obj2.parentNode.style.display='none';
    }
</script>


</body>
</html>
