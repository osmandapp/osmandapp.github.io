<?php
  if($_SERVER['SERVER_NAME'] == 'builder.osmand.net') {
  	include '../reports/db_conn.php';
  	$dbconn = db_conn();
    $visiblename = pg_escape_string($dbconn, $_POST["visibleName"]);
    $useremail = pg_escape_string($dbconn, $_POST["email"]);
    $email = pg_escape_string($dbconn, $_POST["cemail"]);
    $country = pg_escape_string($dbconn, $_POST["preferredCountry"]);
    $userid = pg_escape_string($dbconn, $_POST["userid"]);
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
    $res['visibleName'] = $_POST["visibleName"]; 
    $res['email'] = $_POST["email"];
    $res['preferredCountry'] = $_POST["preferredCountry"]; 
    $res['userid'] = $_POST["userid"]; 
	  echo json_encode($res);
  } else {
  	echo file_get_contents("http://builder.osmand.net/subscription/update.php?".$_SERVER['QUERY_STRING']);
  }
?>