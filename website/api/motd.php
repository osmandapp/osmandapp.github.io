<?php
// lang is also passwed
$DISCOUNT_START = "2018-05-12 00:00";
$DISCOUNT_END = "2018-05-15 00:00";

$TEST_IP = '82.217.128.95';

date_default_timezone_set('UTC');
$iosVersion  = isset($_GET['os']) && $_GET['os'] == 'ios';
$appVersion3 = isset($_REQUEST['version']) && (strpos($_REQUEST['version'] , '3.') ) !== false;
$today = date("Y-m-d H:i");

if(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] == $TEST_IP) {
	echo file_get_contents("messages/test_motd.json");	
} else if($today > $DISCOUNT_START && $today < $DISCOUNT_END) {
	$start = date("d-m-Y H:i", strtotime($DISCOUNT_START));
	$end = date("d-m-Y H:i", strtotime($DISCOUNT_END));
	if($iosVersion) {
		// url supported: 
		// 1. screen in app [screen:in_apps], [in_app:<inappid>]
		// 2. http url supported
		$txt = file_get_contents("messages/discount_ios.json");
	} else {
		// url supported: 
		// 1. "osmand-market-app:net.osmand.plus" - market redirect
		// 2. http url supported
		$txt = file_get_contents("messages/discount.json");
	}
	$json = json_decode($txt);
	$json->start = $start;
	$json->end = $end;
	echo json_encode($json);
} else if(!$iosVersion && $appVersion3) {
	echo file_get_contents("messages/top_wikivoyage.json");		
} else {
	echo "{}";
}

?>
