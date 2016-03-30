<?php
include_once 'db_queries.php';
$res = getRecipients();
echo json_encode($res);
?>