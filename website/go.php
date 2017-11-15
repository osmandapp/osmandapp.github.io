<?php
header('HTTP/1.1 302 Found');
if ($_SERVER['SERVER_NAME'] == 'download.osmand.net') {
  header('Location: https://'.$_SERVER['SERVER_NAME'].'/go.html?'.$_SERVER['QUERY_STRING']);
} else {
  header('Location: http://'.$_SERVER['SERVER_NAME'].'/go.html?'.$_SERVER['QUERY_STRING']);
}
?>
