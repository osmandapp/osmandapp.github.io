<?php
if(isset($argv[1])) {
   $_REQUEST['month'] = $argv[1];
   $_REQUEST['dbmonth'] = $argv[1];
   $_GET['month'] = $argv[1];
   $_GET['dbmonth'] = $argv[1];
}
include '../db_queries.php';
echo "Generate all reports\n";
$r = getAllReports($argv[2], $argv[3]);
if(isset($r->payouts)) {
	echo "Payouts ".json_encode($r->payouts)."\n";
}
?>
