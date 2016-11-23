<?php
include_once 'db_queries.php';
if(!isset($_REQUEST['region'])) {
  $rregion = ''; 
} else {
  $rregion = $_REQUEST['region'];
}

header("Content-Description: Json report");
header("Content-Disposition: attachment; filename=report-$rregion-".$_REQUEST["month"].".json");
header("Content-Type: mime/type");
if($_REQUEST["report"] == "total") {
	echo json_encode(getTotalReport());	
} else {
	echo json_encode(getReport($_REQUEST["report"], $rregion));
}

?>