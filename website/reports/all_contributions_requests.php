<?php
include_once 'db_queries.php';
echo "[" . json_encode(getTotalChanges()). ",  " . json_encode(calculateRanking()).", ". 
		 json_encode(calculateUsersRanking()) . "]";

?>
