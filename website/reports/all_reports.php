<?php
include 'db_queries.php';
$r = getAllReports();
echo "Stored ".count($r->reports)." reports";
?>
