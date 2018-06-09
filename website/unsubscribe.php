<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
if (!empty($_SERVER['QUERY_STRING'])) {
    if($_SERVER['SERVER_NAME'] == 'builder.osmand.net') {
        include 'reports/db_queries.php';
        insertIntoUnsubscribed(base64_decode( urldecode( $_GET["id"] ) ), $_GET["group"]);
    }
    else {
        $ctx = stream_context_create(array('http'=> array('timeout' => 600)  ));
        file_get_contents("http://builder.osmand.net/unsubscribe?".$_SERVER['QUERY_STRING'], false, $ctx);
    }
}
?>

<div style="width:75%; margin: auto; padding-top: 2%; background:#ffffff;">
    <img style="display: block; margin-left: auto; margin-right: auto;" src="/images/logo-grey.png"/>
    <p style="font-family: sans-serif; font-size: 18px; text-align: center;">You have sucessfully unsubscribed from OsmAnd's mailing list.</p>
</div>
