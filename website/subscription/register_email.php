
<?php

  
  include '../reports/db_conn.php';
  $dbconn = db_conn();

  $email = pg_escape_string($dbconn, $_POST["email"]);
  $aid = pg_escape_string($dbconn, $_POST["aid"]);
  $time = time() * 1000;
  $result = pg_query($dbconn, "INSERT INTO map_users(aid, email, updatetime) 
      VALUES('{$aid}','{$email}',${time});");
  if(!$result) {
  	$res = array();        
    $res['error'] = "Error updating db";
    echo json_encode($res);
    die;	
  }
  $res = new stdClass();        
  $res->email = $_POST["email"];
  $res->time = $time;
	 echo json_encode($res);

?>
