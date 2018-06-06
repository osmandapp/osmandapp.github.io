<?php
include 'reports/db_queries.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);
echo ("You have sucessfully unsubscribed from OsmAnd's mailing list.");
insertIntoUnsubscribed(base64_decode( urldecode( $_GET["id"] ) ), $_GET["group"]);

?>
