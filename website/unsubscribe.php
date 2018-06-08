<?php
include 'reports/db_queries.php';
if($_SERVER['SERVER_NAME'] != 'builder.osmand.net') {
  file_get_contents("http://builder.osmand.net/unsubscribe?id=".$_GET["id"]."&group=".$_GET["group"]);
}
else
{
  insertIntoUnsubscribed(base64_decode( urldecode( $_GET["id"] ) ), $_GET["group"]);
}

?>

<div style="width:75%; margin: auto; padding-top: 2%; background:#ffffff;">
    <img style="display: block; margin-left: auto; margin-right: auto;" src="/images/logo-grey.png"/>
    <p style="font-family: sans-serif; font-size: 18px; text-align: center;">You have sucessfully unsubscribed from OsmAnd's mailing list.</p>
</div>
