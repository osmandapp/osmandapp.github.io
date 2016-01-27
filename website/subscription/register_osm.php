<?php
  if($_SERVER['SERVER_NAME'] == 'builder.osmand.net') {
  	include '../reports/db_conn.php';
  	$dbconn = db_conn();
    $osm_usr = pg_escape_string($dbconn, $_POST["osm_usr"]);
    $osm_pwd = pg_escape_string($dbconn, $_POST["osm_pwd"]);
    $bitcoin = pg_escape_string($dbconn, $_POST["bitcoin_addr"]);
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
    $resosm = file_get_contents("https://api.openstreetmap.org//api/0.6/user/details", false, $context);
    if ($resosm === false) {
        $res = array();        
        $res['error'] = "Couldn't authenticate on osm server";
        echo json_encode($res);
        die;
    }
    $result = pg_query($dbconn, "INSERT INTO osm_recipients(osmid, btcaddr, updatetime) 
      VALUES('{$osm_usr}','{$bitcoin}',${time});");
  	if(!$result) {
  	    $res = array();        
        $res['error'] = "Error updating db";
        echo json_encode($res);
        die;	
  	}
    $res = array();        
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