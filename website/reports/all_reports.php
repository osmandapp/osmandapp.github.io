<?php
include 'db_queries.php';
set_time_limit(900);
$r = getAllReports();
echo "Stored ".count($r->reports)." reports\n";
if(isset($_REQUEST['eurValue'])) {
	echo "Payouts ".json_encode($r->payouts)."\n";
}
?>
