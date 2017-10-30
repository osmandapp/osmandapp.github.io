<?php
// if(!class_exists("Memcache")) {
if($_SERVER['SERVER_NAME'] == 'builder.osmand.net') {
	$memcache = new Memcached;
	$memcache->addServer('localhost', 11211) or die ("Can't connect");
	$key_mem = "qreport_" . $_SERVER['QUERY_STRING'];
	$key_mem = str_replace("&force=true","",$key_mem);
	$get_result = $memcache->get($key_mem);
	$timeout = 24*60*60; 
	if(!$get_result || isset($_REQUEST['force']) ) {
  		$get_result = file_get_contents("http://builder.osmand.net/reports/".$_GET["report"].".php?".$_SERVER['QUERY_STRING']);
  		$json_res = json_decode($get_result);
  		$json_res->timeout = time();
  		//if($_GET["report"] == "supporters_by_month") {
  		//	$timeout = 10;
  		//}
  		$memcache->set($key_mem, json_encode($json_res), $timeout);
  		$get_result = json_encode($json_res);
	} else {
		// keep 1 day at least
		$memcache->touch($key_mem, $timeout);
	}
	echo $get_result;
	die;
}
echo file_get_contents("http://builder.osmand.net/reports/query_report.php?".$_SERVER['QUERY_STRING']);
?>