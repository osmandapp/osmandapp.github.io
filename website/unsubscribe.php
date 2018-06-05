<?php
include 'db_queries.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

insertIntoUnsubscribed(base64_decode( urldecode( $_GET["id"] ) ), $_GET["group"]);

?>