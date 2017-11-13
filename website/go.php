<?php
header('HTTP/1.1 302 Found');
header('Location: http://'.$_SERVER['SERVER_NAME'].'/go.html?'.$_SERVER['QUERY_STRING']);
?>
