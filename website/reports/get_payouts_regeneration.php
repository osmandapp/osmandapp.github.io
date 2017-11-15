<?php
include_once 'db_queries.php';
include_once 'db_conn.php';
$dbconn = db_conn();
$res = getAllReports(NULL, NULL);
$month = $_GET["month"];
$name = $_GET["name"];
pg_query($dbconn, "delete from final_reports where month = '${month}' and name = '${name}';");
saveReport($name, $res->payouts, $month, '', 0);
echo "Report saved!"
?>
