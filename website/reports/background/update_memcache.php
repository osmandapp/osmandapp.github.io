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
		$time_start = microtime(true);
		$query = substr($key, strlen("qreport_")) ;
		echo "====== QUERY  $query ======\n";
		
		echo file_get_contents("http://builder.osmand.net/reports/query_report?".$query."&force=true";
		$time_end = microtime(true);
		$time = $time_end - $time_start;
	
		echo "\n====== DONE $time seconds ======\n";
	}

}
// var_dump( $c->getAllKeys() );
?>