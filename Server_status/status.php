<!DOCTYPE HTM>
<html>
    <head>
	<title>X szerver</title>
	<meta charset="utf-8" />
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta http-equiv="refresh" content="60; url=./status.php" />
	<link rel="shortcut icon" href="favicon.png">
	<link rel="icon" type="image/x-icon" href="favicon.png">
    </head>
    <link rel="stylesheet" href="site.css">
<body>

<div class="all-page">



<header>
<div class="menu">
    <ul class="sidenav">
	<li><a class="active" href="index.html">Kezdőlap</a></li>
	<li><a href="http://localhost:10000">Webmin</a></li>
	<li style="float:right;top:5px;"><a href="./index-local.php">Helyi</a></li>
    </ul>
</div>

</header>

<div class="gt-gototop" onclick="topFunction()" id="gt-gototop" title="">
<div class="gt-gototop-icon">&#8593;</div>
</div>




<div class="content">

<h1>X szerver</h1>

<div class="sspaceline"></div>

    <center>
    <img src=stat.jpg class=cimg width=300px height=100px>
    <div class="spaceline50"></div>

    <table class="tablecl">

    <tr><td class=td1>Szerver idő</td><td class=td2>
    <?php
	$s=date('Y. m. d. H:i');
	echo($s);
    ?>
    </td></tr>

    <?php
	$core_nums=trim(shell_exec("grep -P '^processor' /proc/cpuinfo|wc -l"));
    ?>
    <tr><td class=td1>CPU (<?php echo($core_nums);?> rendszermag)</td><td class=td2>
    <?php
	$loads=sys_getloadavg();
	$core_nums=trim(shell_exec("grep -P '^processor' /proc/cpuinfo|wc -l"));
	$load=round($loads[0]/($core_nums)*100,2);
	echo("$load%");
    ?>
    </td></tr>

    <tr><td class=td1>Memória</td><td class=td2>
    <?php
	$free=shell_exec('free');
	$free=(string)trim($free);
	$free_arr=explode("\n",$free);
	$mem=explode(" ",$free_arr[1]);
	$mem=array_filter($mem);
	$mem=array_merge($mem);
	echo("összes: ".round($mem[1]/1024,0) ."Mb <br />szabad: ".round($mem[3]/1024,0)."Mb");
    ?>
    </td></tr>

    <tr><td class=td1>Futási idő</td><td class=td2>
    <?php
	#echo(shell_exec("uptime -p"));
	$str = @file_get_contents('/proc/uptime');
	$num = floatval($str);
	$secs = fmod($num, 60);
	$num = intdiv($num, 60);
	$mins = $num % 60;
	$num = intdiv($num, 60);
	$hours = $num % 24;
	$num = intdiv($num, 24);
	$days = $num;
	echo("$days nap, $hours óra, $mins perc");
    ?>
    </td></tr>

    <tr><td class=td1>Szerver OS verzió</td><td class=td2>
    <?php
	echo(php_uname('s')." ".php_uname('n')." ".php_uname('r')." ".php_uname('m'));
    ?>
    </td></tr>

    <tr><td class=td1>Web szerver</td><td class=td2>
    <?php
	echo(apache_get_version());
    ?>
    </td></tr>

    <tr><td class=td1>PHP verzió</td><td class=td2>
    <?php
	echo(PHP_VERSION);
    ?>
    </td></tr>

    <tr><td class=td1>MySQL / MariaDB verzió</td><td class=td2>
    <?php
	$output=shell_exec('mysql -V'); 
	preg_match('@[0-9]+\.[0-9]+\.[0-9]+@',$output,$version);
	$v=explode(',',$output);
	echo($v[0]);
    ?>
    </td></tr>

    </table>
    </center>


</div>

<footer>

<div class="menu">
<ul class="sidenav">
<li><span>© <?php echo(date('Y'));?>.</span></li>
<li><a target='_blank' href=https://github.com/pphome2>pphome2</a></li>
<li style="float:right;padding-right:20px;"><span>


</span></li>
</ul>
</div>
</footer>

</div>

</body>
</html>
