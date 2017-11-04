<?php
include_once 'db_queries.php';
$data = calculateUserRanking().",".calculateRanking().",".getTotalChanges();
echo json_encode($data);
?>
