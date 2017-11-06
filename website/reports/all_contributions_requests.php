<?php
include_once 'db_queries.php';
//$data = (array) calculateUserRanking();
//$firstMerge = array_merge($data, (array) calculateRanking());
//$secondMerge = array_merge($firstMerge, (array) getTotalChanges());
echo json_encode(getTotalChanges()) + "\n";
echo json_encode(calculateUserRanking()) + "\n";
echo json_encode(calculateRanking());
?>
