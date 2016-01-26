<?php
  if($_SERVER['SERVER_NAME'] == 'builder.osmand.net') {
  	include '../reports/db_conn.php';
  	$dbconn = db_conn();
    $userid = pg_escape_string($dbconn, $_POST["userid"]);
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
  	echo file_get_contents("http://builder.osmand.net/subscription/update.php?".$_SERVER['QUERY_STRING']);
  }
?>