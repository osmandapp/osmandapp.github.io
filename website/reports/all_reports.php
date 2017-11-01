<?php
if(isset($argv[1])) {
   $_REQUEST['month'] = $argv[1];
   $_REQUEST['dbmonth'] = $argv[1];
   if(isset($argv[2])) {
        $_REQUEST['eurValue'] = $argv[2];
        $_REQUEST['btcValue'] = $argv[3];
   }
}
include 'db_queries.php';
set_time_limit(900);
$r = getAllReports();
echo "Stored ".count($r->reports)." reports\n";
if(isset($_REQUEST['eurValue'])) {
	echo "Payouts ".json_encode($r->payouts)."\n";
}
?>
