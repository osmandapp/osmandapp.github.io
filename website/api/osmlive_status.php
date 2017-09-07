<?php

$path = "/home/paul/osmand/"; 
$latest_ctime = 0;

$files = scandir($path);

foreach($files as $file) 
{
  $fullpath = "{$path}/{$file}";
  if (is_file($fullpath) && filemtime($fullpath) > $latest_ctime) {
    $latest_ctime = filemtime($fullpath);
  }
}
echo date('Y-m-d H:i:s', $latest_ctime);

?>
