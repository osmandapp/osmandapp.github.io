<?php

$file = fopen("../.proc_timestamp","r");
echo fgets($file);
fclose($file);

?>
