<?php
include_once 'db_queries.php';
$data = calculateUserRanking();
$firstMerge = array_merge(calculateUserRanking(), calculateRanking());
$secondMerge = array_merge($firstMerge, getTotalChanges());
echo json_encode($secondMerge);
?>
