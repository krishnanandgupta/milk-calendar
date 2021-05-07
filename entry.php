<?php
include 'db_config.php';
if (isset($_GET["milk"])) {
    mysql_query("UPDATE `milk` SET `".$_GET["dd"]."`='".$_GET["milk"]."' WHERE `month` = '".$_GET["yy"]."-".$_GET["mm"]."'");
    header('Location: /index.php?m='.$_GET["mm"].'&y='.$_GET["yy"]);
} 
elseif (isset($_GET["dd"]) && isset($_GET["mm"]) && isset($_GET["yy"])) {
    $dd = $_GET["dd"];
    $mm = $_GET["mm"];
    $yy = $_GET["yy"];
?>

<html>
<head>
<meta content="width=device-width, initial-scale=1" name="viewport">
<link href="style.css" rel="stylesheet">
</head>
<body>

<body>
<h1>Milk Calendar</h1>
<div class="container">
<h3><?php echo $dd.' '.$mts[$mm - 1].', '.$yy; ?></h3>
<form class="frame" method="get" href="/entry.php">
    <h4>Quantity of Milk</h4>
<?php 
echo '
	<a class="btn green" href="?dd='.$dd.'&mm='.$mm.'&yy='.$yy.'&milk=.5"><b>1/2L Liter</b></a>
	<a class="btn" href="?dd='.$dd.'&mm='.$mm.'&yy='.$yy.'&milk=1"><b>1L Liter</b></a>
	<a class="btn red" href="?dd='.$dd.'&mm='.$mm.'&yy='.$yy.'&milk=0"><b>ABS</b></a>';
?>
  </form>
	<br>
<a href="/">Goto Current Month</a>
</div>
</body>
</html>
<?php
} else {
    header("Location: /index.php");
} ?>
