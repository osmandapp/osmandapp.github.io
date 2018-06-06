<?php
include 'reports/db_queries.php';
echo ("You have sucessfully unsubscribed from OsmAnd's mailing list.");
insertIntoUnsubscribed(base64_decode( urldecode( $_GET["id"] ) ), $_GET["group"]);

?>
