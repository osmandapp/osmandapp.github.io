<?php
include_once 'db_queries.php';

$month = $_GET["month"];
$name = $_GET["name"];
$res = generatePayoutReport($month);
saveReport($name, $res->payouts, $month, '', 0);
echo "Report saved!";
?>
