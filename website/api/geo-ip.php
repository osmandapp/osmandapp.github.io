<?php
 $obj = json_decode(file_get_contents("http://freegeoip.net/json/".$_SERVER['REMOTE_ADDR']));
 if($obj->lat  && $obj->lon && !obj->latitude && !obj->longitude) {
    $obj->latitude = $obj->lat;
    $obj->longitude = $obj->lon;
 }
  
 echo json_encode($obj);
?>
