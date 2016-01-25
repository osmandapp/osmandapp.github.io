<?php
  if($_SERVER['SERVER_NAME'] == 'builder.osmand.net') {
  	include '../reports/db_conn.php';
  	$dbconn = db_conn();
	$visiblename = pg_escape_string($dbconn, $_POST["visibleName"]);
	$useremail = pg_escape_string($dbconn, $_POST["email"]);
	$country = pg_escape_string($dbconn, $_POST["preferredCountry"]);
	$result = pg_query($dbconn, "UPDATE supporters SET visiblename='{$visiblename}', preferred_region='{$country}' ".
  		" where useremail='${useremail}' RETURNING userid;");
	$insert = !$result;
	if(!$insert) {
		$row = pg_fetch_row($result);
		if(!$row) {
			$insert = true;
		}
	}

	if($insert) {
  		$result = pg_query($dbconn, "INSERT INTO supporters(userid, visiblename, useremail, preferred_region)  ".
  			" VALUES (nextval('supporters_seq'), '{$visiblename}', '{$useremail}', '{$country}') RETURNING userid;");
  		$row = pg_fetch_row($result);
  		if(!$result) {
  			$res = array();        
  			$res['error'] = "Error";
  			echo json_encode($res);
  			die;
  		}
  		
  	}  	
    $res = array();        
    $res['visibleName'] = $_POST["visibleName"]; 
    $res['email'] = $_POST["email"];
    $res['preferredCountry'] = $_POST["preferredCountry"]; 
    $res['userid'] = $row[0]; 
	echo json_encode($res);
  } else {
  	echo file_get_contents("http://builder.osmand.net/subscription/register.php?".$_SERVER['QUERY_STRING']);
  }
?>