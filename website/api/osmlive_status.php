<?php

$path = __DIR__ . '/../_diff'; 
$latest_ctime = 0;
echo "test1";

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
