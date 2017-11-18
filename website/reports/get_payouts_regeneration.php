<?php
include_once 'db_queries.php';

$month = $_GET["month"];
$name = $_GET["name"];
if ($month == date("Y-m") || $name != 'getPayouts') {
 echo "Only use for previous months and 'getPayouts' report";
 die;
}
$res = getAllReports(getEurValue(0), getBTCValue(0, 0));
echo "\nReport saved!";
?>
