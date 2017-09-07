<?php
$path = "/home/osm-planet/osmlive/_diff"; 

$latest_ctime = 0;

$d = dir($path);
while (false !== ($entry = $d->read())) {
  $filepath = "{$path}/{$entry}";
  // could do also other checks than just checking whether the entry is a file
  if (is_file($filepath) && filemtime($filepath) > $latest_ctime) {
    $latest_ctime = filemtime($filepath);
  }
}

echo date('Y-m-d H:i:s', $latest_ctime);
?>
