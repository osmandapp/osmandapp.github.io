<?php
function grab_dump($var)
{
    ob_start();
    var_dump($var);
    return ob_get_clean();
}

  
  	include '../reports/db_conn.php';
  	$dbconn = db_conn();
    $date = date('m/d/Y h:i:s a', time());
    $dump = grab_dump($_REQUEST);
    error_log($date." : user id '".$_REQUEST["userid"]."' token '".$_REQUEST["token"]."' ".$dump."\n", 3, "/var/log/purchased.log");
    $userid = pg_escape_string($dbconn, $_REQUEST["userid"]);
    $token = pg_escape_string($dbconn, $_REQUEST["token"]);
    // temporarily disable unless token issue is fixed
    // $result = pg_query($dbconn, "SELECT userid, token, visiblename, useremail, preferred_region from supporters where userid = '{$userid}' and token = '{$token}';"); 
    $result = pg_query($dbconn, "SELECT userid, token, visiblename, useremail, preferred_region from supporters where userid = '{$userid}';");
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
    
    $result = pg_query($dbconn, "INSERT INTO supporters_device_sub(userid, sku, purchasetoken, timestamp) 
      VALUES('{$userid}','{$sku}','{$purchaseToken}',to_timestamp(${time})) 
      WHERE not exists (SELECT 1 from supporters_device_sub
             WHERE userid = '{$userid}' and sku='{$sku}' and purchasetoken='{$purchaseToken}');");
  	if(!$result) {
  		$res = array();        
  		$res['error'] = "Error";
  		echo json_encode($res);
  		die;
  	}
    
    $res['status'] = 'OK';
	  echo json_encode($res);

?>
