<?php
// TODO move it to background folder & make not accessible
if(isset($argv[1])) {
   $_REQUEST['month'] = $argv[1];
   $_REQUEST['dbmonth'] = $argv[1];
   $_GET['month'] = $argv[1];
   $_GET['dbmonth'] = $argv[1];
   if(isset($argv[2])) {
        $_REQUEST['eurValue'] = $argv[2];
        $_REQUEST['btcValue'] = $argv[3];
        $_GET['eurValue'] = $argv[2];
        $_GET['btcValue'] = $argv[3];
   }
   $_SERVER['REQUEST_METHOD'] = 'POST';
}
include 'db_queries.php';
echo "Generate all reports\n";
$r = getAllReports();
echo "\nStored ".count($r->reports)." reports\n";
if(isset($_REQUEST['eurValue'])) {
	echo "Payouts ".json_encode($r->payouts)."\n";
}
?>
