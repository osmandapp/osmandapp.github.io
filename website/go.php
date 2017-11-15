<?php
header('HTTP/1.1 302 Found');
if ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
    || $_SERVER['SERVER_PORT'] == 443) {
  header('Location: https://'.$_SERVER['SERVER_NAME'].'/go.html?'.$_SERVER['QUERY_STRING']);
} else {
  header('Location: http://'.$_SERVER['SERVER_NAME'].'/go.html?'.$_SERVER['QUERY_STRING']);
}
?>
