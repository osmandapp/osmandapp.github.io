<?php
  if($_SERVER['SERVER_NAME'] == 'builder.osmand.net') {
  	include '../reports/db_conn.php';
  	$dbconn = db_conn();
    $visiblename = pg_escape_string($dbconn, $_GET["visibleName"]);
    $useremail = pg_escape_string($dbconn, $_GET["email"]);
    $email = pg_escape_string($dbconn, $_GET["cemail"]);
    $country = pg_escape_string($dbconn, $_GET["preferredCountry"]);
    $userid = pg_escape_string($dbconn, $_GET["userid"]);
  	$result = pg_query($dbconn, "UPDATE SET visiblename='{$visiblename}', useremail='{$useremail}', preferred_region='{$country}' ".
  		" where userid = '{$userid}' and useremail='${cemail}';");
  	if(!$result) {
  		$res = array();        
  		$res['error'] = "Error";
  		echo json_encode($res);
  		die;
  	}
  	$row = pg_fetch_row($result);
    $res = array();        
    $res['visibleName'] = $_GET["visibleName"]; 
    $res['email'] = $_GET["email"];
    $res['preferredCountry'] = $_GET["preferredCountry"]; 
    $res['userid'] = $row[0]; 
	echo json_encode($res);
  } else {
  	echo file_get_contents("http://builder.osmand.net/subscription/register.php?".$_SERVER['QUERY_STRING']);
  }
?>