<?php
if(!class_exists("Memcache")) {
	echo file_get_contents("http://builder.osmand.net/reports/".$_GET["report"].".php?".$_SERVER['QUERY_STRING']);
	die;
}
$memcache = new Memcache;
$memcache->connect('localhost', 11211) or die ("Can't connect");
$get_result = $memcache->get($_SERVER['QUERY_STRING']);
if(!$get_result) {
  $get_result = file_get_contents("http://builder.osmand.net/reports/".$_GET["report"].".php?".$_SERVER['QUERY_STRING']);
  $timeout = 120000;
  if(!isset($_GET['month']) || strlen($_GET["month"]) == 0 || date("Y-m") == $_GET["month"]) {
  	$timeout = 300; 	
  }
  $memcache->set($_SERVER['QUERY_STRING'], $get_result, 0, $timeout);

}
echo $get_result;
?>