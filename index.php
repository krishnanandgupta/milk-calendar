<?php
include 'db_config.php';
if (isset($_GET["m"])&&isset($_GET["y"])){
	$mm  = $_GET["m"];
	$yy  = $_GET["y"];
	$cm = 0;
}
else {
	$mm  = date("n");
	$yy  = date("Y");
	$cm = 1;
}

if($mm==1){
	$p_mm=12;
	$p_yy=$yy-1;
}
else{
	$p_mm=$mm-1;
	$p_yy=$yy;
}	

if($mm==12){
	$n_mm=1;
	$n_yy=$yy+1;
}
else{
	$n_mm=$mm+1;
	$n_yy=$yy;
}	
// if it's the first day of the month
$day=date("w",strtotime("$mm/01/$yy"));
$result = mysql_query("SELECT * FROM milk Where month='$yy-$mm'");
$row = mysql_fetch_array($result);
//print_r($row);
?>	


<html>
<head>
<meta content="width=device-width, initial-scale=1" name="viewport">
<link href="pandit.css" rel="stylesheet">
<style>
html {box-sizing: border-box;font-size: 10px;}body {font-family: -apple-system, BlinkMacSystemFont,"Segoe UI", Roboto, Helvetica, Arial, sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol";color: #333;font-size: 1.6rem;background-color: #FAFAFA;-webkit-font-smoothing: antialiased;}.logo {margin: 1.6rem auto;text-align: center;}a,a:visited {color: #0A9297;}footer {text-align: center;margin: 1.6rem 0;}h1 {text-align: center;}.container {width: 96%;margin: 1.6rem auto;max-width: 42rem;text-align: center;}.demo-picked {font-size: 2rem;text-align: center;background-color: #e7e9ed;}.demo-picked span {font-weight: bold;}
</style>
</head>
<body>
<div class="container">
<h1>Milk Calendar</h1>
<div id="v-cal">
<div class="vcal-header">
<?php echo '<a class="vcal-btn" href="?m='.$p_mm.'&y='.$p_yy.'">'; ?>
<svg height="24" version="1.1" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
<path d="M20,11V13H8L13.5,18.5L12.08,19.92L4.16,12L12.08,4.08L13.5,5.5L8,11H20Z">
</path>
</svg>
</a>
<div class="vcal-header__label" data-calendar-label="month">
<?php echo $mts[$mm-1].' '.$yy;?>
</div>
<?php echo '<a class="vcal-btn" href="?m='.$n_mm.'&y='.$n_yy.'">'; ?>
<svg height="24" version="1.1" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
<path d="M4,11V13H16L10.5,18.5L11.92,19.92L19.84,12L11.92,4.08L10.5,5.5L16,11H4Z">
</path>
</svg>
</a>
</div>
<div class="vcal-week">
<span>Mon</span><span>Tue</span><span>Wed</span><span>Thu</span><span>Fri</span><span>Sat</span><span>Sun</span></div>
<div class="vcal-body">
<?php
$total=0;

for($i=1;$i<=$row['num_day'];$i++){
	echo '<a href="/entry.php?dd='.$i.'&mm='.$mm.'&yy='.$yy.'"';
	if($i==1) 
		echo 'class="vcal-date" style="margin-left:'. $day*14.28 .'%">';	
	elseif($cm && $i==date("d"))
		echo 'class="vcal-date vcal-date--today">';		
	else 
		echo 'class="vcal-date">';
	echo '<b>'.$i.'</b><span class="vcal-date--disabled">';
	if(!is_null($row[$i])){		
		if($row[$i]!=0 ){
			echo $row[$i].' L';
			$total+=$row[$i];	
		}
		else
			echo 'ABS';
	}


	
	echo '</span></a>';
}	
?>
</div>
</div>
<p class="demo-picked">TOTAL : <span><?php echo $total;?> Liter</span></p>
<a href="/">Goto Current Month</a>
</div>
</body>
</html>
