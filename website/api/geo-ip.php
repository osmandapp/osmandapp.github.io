<?php
 $obj = json_decode(file_get_contents("http://freegeoip.net/json/".$_SERVER['REMOTE_ADDR']));
 if(!is_null($obj->lat) && !is_null($obj->lon) && is_null($obj->latitude) && is_null($obj->longitude)) {
    $obj->latitude = $obj->lat;
    $obj->longitude = $obj->lon;
 }
  
 echo json_encode($obj);
?>
