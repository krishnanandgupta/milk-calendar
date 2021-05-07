<?php
date_default_timezone_set("asia/calcutta");
// Mysql database settings
$user = "root";
$password = "usbw";
$database = "milk";
$host = "localhost";

mysql_connect($host, $user, $password);
mysql_select_db($database) or die("Unable to select database");

$mts = [
    'January',
    'Febuary',
    'March',
    'April',
    'May',
    'June',
    'July',
    'August',
    'September',
    'October',
    'November',
    'December',
];

?>
