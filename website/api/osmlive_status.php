<?php
error_reporting(E_ALL); 
ini_set('display_errors','1');
$path = "/var/www-download/_diff";
$file = fopen(__DIR__."/../.proc_timestamp","r");
$date = fgets($file);
echo $date;
fclose($file);

/*
$latest_ctime = 0;
if (is_link($path)) {
  echo "is symlink";
}

$files = scandir($path);
/*
foreach($files as $file) 
{
  $fullpath = "{$path}/{$file}";
  if (is_file($fullpath) && filemtime($fullpath) > $latest_ctime) {
    $latest_ctime = filemtime($fullpath);
  }
}
echo date('Y-m-d H:i:s', $latest_ctime);*/

?>
