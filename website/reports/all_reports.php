<?php
include 'db_queries.php';
set_time_limit(900);
$r = getAllReports();
echo "Stored ".count($r->reports)." reports\n";
if(isset($_REQUEST['eurValue'])) {
	//echo "Total payouts ".json_encode($r->payoutTotal)."\n";
	echo "Total payouts ".json_encode($r)."\n";
	echo "Payouts ".json_encode($r->payouts)."\n";
}
?>
