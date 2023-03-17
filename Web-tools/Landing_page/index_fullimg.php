<?php

#
# Full image landing page
#
# 2019. WSWDTeam GPLv3
#
#


	$LP_TITLE='Landing page';
	$LP_GOTOPAGE='./index_fullimg.php';
	$LP_RELOAD_SEC=10;

	$LP_FIRSTPAGE_NAME='Kezdőlap';
	$LP_FIRSTPAGE_LINK='index.html';

	$LP_FAVICON='favicon.png';
	$LP_CSS='';

	$LP_BACKGROUND_IMAGE='./img.jpg';

	$LP_COPYRIGHT_NAME='WSWDTeam';
	$LP_COPYRIGHT_LINK='./index_fullimg.php';

	$LP_CENTER_TEXT='Ez egy induló oldal.';
	$LP_CENTER_BUTTON_NAME='Kezdőlap';
	$LP_CENTER_BUTTON_LINK='index.html';

	$LP_HEADER_SHOW=false;
	$LP_FOOTER_SHOW=false;

?>


<!DOCTYPE HTM>
<html>
    <head>
		<title><?php echo($LP_TITLE); ?></title>
		<meta charset="utf-8" />
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<?php if ($LP_RELOAD_SEC>0){ ?>
			<meta http-equiv="refresh" content="<?php echo($LP_RELOAD_SEC.'; '.$LP_GOTOPAGE); ?>" />
		<?php } ?>
		<link rel="shortcut icon" href="<?php echo($LP_FAVICON); ?>">
		<link rel="icon" type="image/x-icon" href="<?php echo($LP_FAVICON); ?>">
    </head>
    <link rel="stylesheet" href="<?php echo($LP_CSS); ?>">
<body>


<style>

body {
    margin:0px;
    font-size:16px;
}

.all-page {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
}

.content {
    mmargin:20px;
    ppadding:20px;
    flex: 1 0 auto;
	background-image:url("<?php echo($LP_BACKGROUND_IMAGE); ?>");
	background-size: cover;
}

.centered {
  position: absolute;
  top: 35%;
  width:100%;
  text-align:center;
  color:white;
}

footer {
    margin: 0;
    padding: 0;
    background-color: #333;
    display: block;
    color: white;
    padding-left: 20px;
    cursor:default;
}

p {
	font-size:2em;
}

p a{
    display: inline-block;
    color: black;
    text-decoration: none;
}

ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #333;
}

li {
    float: left;
    text-decoration: none;
}

li a, span {
    display: inline-block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

li a:hover, .dropdown:hover .dropbtn {
    background-color: red;
}

li.dropdown {
    display: inline-block;
}

.spaceline {
   padding-top:25px;
}

.spaceline50 {
   padding-top:50px;
}

.spaceline100 {
   padding-top:100px;
}

.btn {
  border: 2px solid gray;
  color: text;
  ttext-align:center;
  background-color: green;
  padding: 10px 50px;
  border-radius: 8px;
  font-size: 20px;
  font-weight: bold;
  text-decoration:none;
}

.btn a{
  text-decoration:none;
  color: white;
}

.btn a:link {
    text-decoration: none;
}

.btn a:visited {
    text-decoration: none;
}

.btn a:hover {
    text-decoration: none;
}

.btn a:active {
    text-decoration: none;
}


</style>


<div class="all-page">

	<?php if ($LP_HEADER_SHOW){ ?>
	<header>
		<div class="menu">
		    <ul class="sidenav">
				<li><a class="active" href="<?php echo($LP_FIRSTPAGE_LINK); ?>"><?php echo($LP_FIRSTPAGE_NAME); ?></a></li>
		    </ul>
		</div>
	</header>
	<?php } ?>


	<div class="content">
		<div class="centered">
			<p><?php echo($LP_CENTER_TEXT); ?></p>
			<?php if ($LP_CENTER_BUTTON_NAME<>''){ ?>
				<div class="spaceline50"></div>
				<a href="<?php if ($LP_CENTER_BUTTON_LINK<>'') {echo($LP_CENTER_BUTTON_LINK);} ?>">
					<span class="btn"><?php echo($LP_CENTER_BUTTON_NAME); ?></span>
				</a>
			<?php } ?>
		</div>
	</div>


	<?php if ($LP_FOOTER_SHOW){ ?>	
	<footer>
		<div class="menu">
			<ul class="sidenav">
				<li><span>© <?php echo(date('Y'));?>.</span></li>
				<li><a target='_blank' href="<?php echo($LP_COPYRIGHT_LINK); ?>"><?php echo($LP_COPYRIGHT_NAME); ?></a></li>
			</ul>
		</div>
	</footer>
	<?php } ?>

</div>

</body>
</html>

