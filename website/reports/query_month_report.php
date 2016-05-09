<?php
include_once 'db_queries.php';
if(!isset($_REQUEST['region'])) {
  $rregion = ''; 
} else {
  $rregion = $_REQUEST['region'];
}

if($_REQUEST["report"] == "total") {
	echo json_encode(getAllReports());	
} else {
	echo json_encode(getReport($_REQUEST["report"], $rregion));
}

?>