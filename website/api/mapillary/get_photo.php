<?php
 header("Content-type: image/jpeg");
 if(isset($_GET['hires'])) {
   echo file_get_contents("https://d1cuyjsrcm0gby.cloudfront.net/".$_GET['photo_id']."/thumb-1024.jpg?origin=osmand");
 } else {
   echo file_get_contents("https://d1cuyjsrcm0gby.cloudfront.net/".$_GET['photo_id']."/thumb-640.jpg?origin=osmand");
 }
?>
