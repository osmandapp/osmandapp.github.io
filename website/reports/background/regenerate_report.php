<?php
if(isset($argv[1])) {
   $_REQUEST['month'] = $argv[1];
   $_REQUEST['dbmonth'] = $argv[1];
   $_GET['month'] = $argv[1];
   $_GET['dbmonth'] = $argv[1];
}
include '../db_queries.php';
echo "Generate $argv[2]\n";
$saveReport = -1;
if($argv[3] == 'save') {
	$saveReport = time();
}

if($argv[2] == 'getPayouts') {
	$payouts = new stdClass();
	$btc = getReport('getBTCValue');
	$eurValue = getReport('getEurValue');
	calculatePayouts($payouts, $btc, $eurValue, $saveReport);
	echo "Payouts $btc $eurValue : \n".json_encode($payouts)."\n";
}
?>
