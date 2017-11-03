<?php
if($_SERVER['SERVER_NAME'] == 'builder.osmand.net') {
	/*
	$memcache = new Memcached;
	$memcache->addServer('localhost', 11211) or die ("Can't connect");
	$key_mem = "qreport_" . $_SERVER['QUERY_STRING'];
	$key_mem = str_replace("&force=true","",$key_mem);
	$get_result = $memcache->get($key_mem);
	//$timeout = 24*60*60; 
	$timeout = 15;
	$currentTime = time();
	if(!$get_result || isset($_REQUEST['force']) ) {
		if ($get_result) {
			$json_prev = json_decode($get_result); 
		}
		
		if(!isset($_REQUEST['month']) || $_REQUEST['month'] == '' || 
				$_REQUEST['month'] == date("Y-m")) {
			// cache in memcache only for current month
			$nextTimeout = $timeout;
			if(!$json_prev) {
				// set something to avoid double calculation
				$memcache->set($key_mem, "{}", $nextTimeout);
			}
			$ctx = stream_context_create(array('http'=> array('timeout' => 600)  ));
			$get_result = file_get_contents("http://builder.osmand.net/reports/".$_GET["report"].".php?".$_SERVER['QUERY_STRING'], false, $ctx);
	
  			$json_res = json_decode($get_result);
  			$json_res->generationTime = $currentTime;

  			
  			if($json_prev && $json_prev->expirationTime) {
  				$nextTimeout = $json_prev->expirationTime - $currentTime;
  			}
  			//if($_GET["report"] == "supporters_by_month") {
  			//	$timeout = 10;
  			//}
  			$json_res->expirationTime = $currentTime + $nextTimeout;
  			$memcache->set($key_mem, json_encode($json_res), $nextTimeout);
  			$get_result = json_encode($json_res);
  		} else {
  			$get_result = file_get_contents("http://builder.osmand.net/reports/".$_GET["report"].".php?".$_SERVER['QUERY_STRING']);
  		}
	} else {
		// keep 1 day at least after request
		$json_res = json_decode($get_result);
		if($json_res->generationTime) {
			// do not recache empty result
  			$json_res->expirationTime = $currentTime + $timeout;
			$memcache->set($key_mem, json_encode($json_res), $timeout);
		}
	}*/
	$ctx = stream_context_create(array('http'=> array('timeout' => 600)  ));
	$get_result = file_get_contents("http://builder.osmand.net/reports/".$_GET["report"].".php?".$_SERVER['QUERY_STRING'], false, $ctx);
	echo $get_result;
	die;
}
echo file_get_contents("http://builder.osmand.net/reports/query_report.php?".$_SERVER['QUERY_STRING']);
?>