<?php
 $content = @file_get_contents("http://localhost:8080/json/".$_SERVER['REMOTE_ADDR']);
 if($content === FALSE) { echo "{}"; die; }
 $obj = json_decode($content);
 if(isset($obj->lat) && isset($obj->lon) && !isset($obj->latitude) && !isset($obj->longitude)) {
    $obj->latitude = $obj->lat;
    $obj->longitude = $obj->lon;
 }
 if(!isset($obj->lat) && !isset($obj->lon) && isset($obj->latitude) && isset($obj->longitude)) {
    $obj->lat = $obj->latitude;
    $obj->lon = $obj->longitude;
 }
  
 echo json_encode($obj);
?>
