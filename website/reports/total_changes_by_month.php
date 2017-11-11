<?php
include_once 'db_queries.php';
// used by android
echo json_encode(getTotalChanges());
?>