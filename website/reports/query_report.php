<?php 
echo  file_get_contents("http://builder.osmand.net/reports/".$_GET["report"].".php?".$_SERVER['QUERY_STRING']);
?>