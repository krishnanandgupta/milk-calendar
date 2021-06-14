<?php
include 'db_config.php';
if (isset($_GET["m"]) && isset($_GET["y"])) {
    $mm = $_GET["m"];
    $yy = $_GET["y"];
} else {
    $mm = date("n");
    $yy = date("Y");
}

if ($mm == 1) {
    $p_mm = 12;
    $p_yy = $yy - 1;
} else {
    $p_mm = $mm - 1;
    $p_yy = $yy;
}

if ($mm == 12) {
    $n_mm = 1;
    $n_yy = $yy + 1;
} else {
    $n_mm = $mm + 1;
    $n_yy = $yy;
}
// if it's the first day of the month
$day = date("w", strtotime("$mm/01/$yy"));
$result = mysql_query("SELECT * FROM milk Where month='$yy-$mm'");
$row = mysql_fetch_array($result);
//print_r($row);
?>
<html>
<head>
<meta content="width=device-width, initial-scale=1" name="viewport">
<link href="pandit.css" rel="stylesheet">
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
<?php echo $mts[$mm - 1].' '.$yy; ?>
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
$total = 0;
//$abs=0;
for ($i = 1; $i <= $row['num_day']; $i++) {
    echo '<a href="/entry.php?dd='.$i.'&mm='.$mm.'&yy='.$yy.'" class="vcal-date';
    if ($i == 1) {
        echo ' ml-'.$day;
    }
    if ($mm == date("n") && $i == date("d")) {
        echo ' vcal-date--today';
    }
    if (!is_null($row[$i]) && $row[$i] == 0) {
        echo ' vcal-date--abs';
    }
    if (!is_null($row[$i]) && $row[$i] == 9) {
        echo ' vcal-date--df';
    }
    echo '"><b>'.$i.'</b><span class="vcal-date--disabled">';
    if (!is_null($row[$i])) {
        if ($row[$i] != 0 && $row[$i] != 9) {
            echo $row[$i].' L';
            $total += $row[$i];
        } 
        elseif($row[$i] == 0) {
            echo 'ABS';
        } 
        else{
            echo 'DF';
        }
    }

    echo '</span></a>';
}
?>
</div>
</div>
<p class="demo-picked">
	TOTAL : <span><?php echo $total; ?> Liter</span> 
	<?php
//echo '& <span>$abs ABS</span>';
?> 
</p>
<a href="/">Goto Current Month</a>
</div>
</body>
</html>