
<?php

  if($_SERVER['SERVER_NAME'] == 'builder.osmand.net') {
  
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
} else {
  	$data = $_POST;
      // use key 'http' even if you send the request to https://...
      $options = array(
          'http' => array(
              'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
              'method'  => 'POST',
              'content' => http_build_query($data),
          ),
      );
      $context  = stream_context_create($options);
      echo file_get_contents("http://builder.osmand.net/subscription/register_email.php?".$_SERVER['QUERY_STRING'], 
            false, $context);
  }
?>
