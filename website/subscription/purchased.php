<?php
  if($_SERVER['SERVER_NAME'] == 'builder.osmand.net') {
  	include '../reports/db_conn.php';
  	$dbconn = db_conn();
    $userid = pg_escape_string($dbconn, $_REQUEST["userid"]);
    $token = pg_escape_string($dbconn, $_REQUEST["token"]);
    $result = pg_query($dbconn, "SELECT userid, token, visiblename, useremail, preferred_region from supporters where userid = '{$userid}' and token = '{$token}';");
    $ok = false;
    $res = array();     
    if($result) {
      $row = pg_fetch_row($result);
      if($row) {
        $ok = $row[0] == $_REQUEST["userid"];
        $res['visibleName'] = $row[2]; 
        $res['email'] = $row[3]; 
        $res['preferredCountry'] = $row[4];  
      }
    }
    if(!$ok) {
      echo json_encode(array( "error" => "User id is not found"));
      die; 
    }
    if(!array_key_exists("purchaseToken", $_POST) || $_POST["purchaseToken"] == '') {
      echo json_encode(array( "error" => "Purchase token is not specified"));
      die; 
    }
    if(!array_key_exists("sku", $_POST) || $_POST["sku"] == '') {
      echo json_encode(array( "error" => "Subscription id is not specified"));
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
    
    $res['status'] = 'OK';
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
      echo file_get_contents("http://builder.osmand.net/subscription/purchased.php?".$_SERVER['QUERY_STRING'], 
            false, $context);
  }
?>