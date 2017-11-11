<?php
if($_SERVER['SERVER_NAME'] == 'builder.osmand.net') {
	$ctx = stream_context_create(array('http'=> array('timeout' => 600)  ));
	$get_result = file_get_contents("http://builder.osmand.net/reports/".$_GET["report"].".php?".$_SERVER['QUERY_STRING'], false, $ctx);
	echo $get_result;
	die;
}
echo file_get_contents("http://builder.osmand.net/reports/query_report.php?".$_SERVER['QUERY_STRING']);
?>