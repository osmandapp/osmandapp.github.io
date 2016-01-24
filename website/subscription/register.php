<?php
  if($_SERVER['SERVER_NAME'] == 'builder.osmand.net') {
  	include '../reports/db_conn.php';
	$visiblename = pg_escape_string($dbconn, $_GET["visibleName"]);
	$useremail = pg_escape_string($dbconn, $_GET["email"]);
	$country = pg_escape_string($dbconn, $_GET["preferredCountry"])
  	$result = pg_query($dbconn, "INSERT INTO supporters(userid, visiblename, useremail, preferred_region)  ".
  		"VALUES (nextval('supporters_seq'), '{$visiblename}', '{$useremail}', '{$country}') RETURNING userid;");
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