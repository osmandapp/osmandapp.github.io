<?php
include_once 'db_queries.php';
echo json_encode(getTotalChanges())."\n";
echo json_encode(calculateRanking())."\n";
echo json_encode(calculateUsersRanking());

?>
