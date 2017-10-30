<?php 
$c = new Memcached(); 
$c->addServer("localhost", 11211); 
var_dump( $c->getAllKeys() );
?>