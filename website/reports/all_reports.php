<?php
include 'db_queries.php';
set_time_limit(900);
$r = getAllReports();
echo "Stored ".count($r->reports)." reports";
if(isset($_REQUEST['eurValue'])) {
	echo "Total payouts ".json_encode($r->payoutTotal);
	echo "Payouts ".json_encode($r->payouts);
}
?>
