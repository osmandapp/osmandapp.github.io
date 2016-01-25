<?php
  if($_SERVER['SERVER_NAME'] == 'builder.osmand.net') {
  	include '../reports/db_conn.php';
  	$dbconn = db_conn();
    $visiblename = pg_escape_string($dbconn, $_REQUEST["visibleName"]);
    $useremail = pg_escape_string($dbconn, $_REQUEST["email"]);
    $email = pg_escape_string($dbconn, $_REQUEST["cemail"]);
    $country = pg_escape_string($dbconn, $_REQUEST["preferredCountry"]);
    $userid = pg_escape_string($dbconn, $_REQUEST["userid"]);
  	$result = pg_query($dbconn, "UPDATE supporters SET visiblename='{$visiblename}', useremail='{$useremail}', preferred_region='{$country}' ".
  		" where userid = '{$userid}' and useremail='${email}' RETURNING userid;");
  	if(!$result) {
  		$res = array();        
  		$res['error'] = "Error";
  		echo json_encode($res);
  		die;
  	}
  	$row = pg_fetch_row($result);
    if(!$row) {
      $res = array();        
      $res['error'] = "Error";
      echo json_encode($res);
      die;
    }
    $res = array();        
    $res['visibleName'] = $_REQUEST["visibleName"]; 
    $res['email'] = $_REQUEST["email"];
    $res['preferredCountry'] = $_REQUEST["preferredCountry"]; 
    $res['userid'] = $_REQUEST["userid"]; 
	  echo json_encode($res);
  } else {
  	echo file_get_contents("http://builder.osmand.net/subscription/update.php?".$_SERVER['QUERY_STRING']);
  }
?>