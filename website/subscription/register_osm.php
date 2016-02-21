
<?php

  if($_SERVER['SERVER_NAME'] == 'builder.osmand.net') {
  function checkAddress($address) {
    $origbase58 = $address;
    $dec = "0";
    for ($i = 0; $i < strlen($address); $i++)
    {
        $dec = bcadd(bcmul($dec,"58",0),strpos("123456789ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz",substr($address,$i,1)),0);
    }
    $address = "";
    while (bccomp($dec,0) == 1)
    {
        $dv = bcdiv($dec,"16",0);
        $rem = (integer)bcmod($dec,"16");
        $dec = $dv;
        $address = $address.substr("0123456789ABCDEF",$rem,1);
    }

    $address = strrev($address);

    for ($i = 0; $i < strlen($origbase58) && substr($origbase58,$i,1) == "1"; $i++) {
        $address = "00".$address;
    }
    if (strlen($address)%2 != 0) {
        $address = "0".$address;
    }
    if (strlen($address) != 50) {
        return false;
    }
    if (hexdec(substr($address,0,2)) > 0) {
        return false;
    }

     return substr(strtoupper(hash("sha256",hash("sha256",pack("H*",substr($address,0,strlen($address)-8)),true))),0,8) == substr($address,strlen($address)-8);
  }
    if(!checkAddress($_POST["bitcoin_addr"])) {
      $res = array();        
        $res['error'] = "Please validate bitcoin address";
        echo json_encode($res);
        die;
    }

  	include '../reports/db_conn.php';
  	$dbconn = db_conn();

    $osm_usr = pg_escape_string($dbconn, $_POST["osm_usr"]);
    $osm_pwd = pg_escape_string($dbconn, $_POST["osm_pwd"]);
    $bitcoin = pg_escape_string($dbconn, $_POST["bitcoin_addr"]);
    $email = pg_escape_string($dbconn, $_POST["email"]);
    $time = time() * 1000;
    $basic = base64_encode($osm_usr.":".$osm_pwd);
    $options = array(
          'http' => array(
              'header'  => "Content-type: application/x-www-form-urlencoded\r\nAuthorization: Basic {$basic}",
              'method'  => 'GET'
              //'content' => http_build_query($data),
          ),
      );
    $context  = stream_context_create($options);
    $resosm = @file_get_contents("https://api.openstreetmap.org//api/0.6/user/details", false, $context);
    if ($resosm === false) {
        $res = array();        
        $res['error'] = "Couldn't authenticate on osm server";
        echo json_encode($res);
        die;
    }
    $result = pg_query($dbconn, "INSERT INTO osm_recipients(osmid, email, btcaddr, updatetime) 
      VALUES('{$osm_usr}','{$email}','{$bitcoin}',${time});");
  	if(!$result) {
  	    $res = array();        
        $res['error'] = "Error updating db";
        echo json_encode($res);
        die;	
  	}
    $res = new stdClass();        
    $res->osm_usr = $_POST["osm_usr"];
    $res->bitcoin_addr = $_POST["bitcoin_addr"];
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
      echo file_get_contents("http://builder.osmand.net/subscription/register_osm.php?".$_SERVER['QUERY_STRING'], 
            false, $context);
  }
?>