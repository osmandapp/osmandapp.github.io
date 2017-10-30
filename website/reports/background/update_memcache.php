<?php 
function startsWith($haystack, $needle)
{
     $length = strlen($needle);
     return (substr($haystack, 0, $length) === $needle);
}

$c = new Memcached(); 
$c->addServer("localhost", 11211); 
foreach($c->getAllKeys() as $key) {
	if(startsWith($key, "qreport_")) {
		echo substr($key, strlen("qreport_")) . "\n";
	}

}
// var_dump( $c->getAllKeys() );
?>