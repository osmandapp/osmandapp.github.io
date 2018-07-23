<?php
 $obj = json_decode(file_get_contents("http://freegeoip.net/json/".$_SERVER['REMOTE_ADDR']));
 if(isset($obj->lat) && isset($obj->lon) && !isset($obj->latitude) && !isset($obj->longitude)) {
    $obj->latitude = $obj->lat;
    $obj->longitude = $obj->lon;
 }
  
 echo json_encode($obj);
?>
