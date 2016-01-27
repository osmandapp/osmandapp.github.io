<?php
  if($_SERVER['SERVER_NAME'] == 'builder.osmand.net') {
  	include '../reports/db_conn.php';
  	$dbconn = db_conn();
    $userid = pg_escape_string($dbconn, $_REQUEST["userid"]);
    $result = pg_query($dbconn, "SELECT userid from supporters where userid = '{$userid}';");
    $ok = false;
    if($result) {
      $row = pg_fetch_row($result);
      if($row) {
        $ok = $row[0] == $_REQUEST["userid"];
      }
    }
    if(!$ok) {
      $res = array();        
      $res['error'] = "User id not found";
      echo json_encode($res);
      die;
    }

    $sku = pg_escape_string($dbconn, $_POST["sku"]);
    $purchaseToken = pg_escape_string($dbconn, $_POST["purchaseToken"]);
    // $email = pg_escape_string($dbconn, $_POST["email"]);
    $time = time() * 1000;
    
    $result = pg_query($dbconn, "INSERT INTO supporters_subscription(userid, sku, purchasetoken, checktime) 
      VALUES('{$userid}','{$sku}','{$purchaseToken}',${time});");
  	if(!$result) {
  		$res = array();        
  		$res['error'] = "Error";
  		echo json_encode($res);
  		die;
  	}
	  echo "OK";
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
      echo file_get_contents("http://builder.osmand.net/subscription/purchased.php?".$_SERVER['QUERY_STRING'], 
            false, $context);
  }
?>