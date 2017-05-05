<?php
 header("Content-type: image/jpeg");
 echo file_get_contents("https://d1cuyjsrcm0gby.cloudfront.net/".$_GET['photo_id']."/thumb-640.jpg?origin=osmand");
?>
