<?php

include 'db_conn.php';
include 'default_vars.php';
$dbconn = db_conn();
if (!$dbconn) {
	echo "{'error':'No db connection'}";
	exit;
}
if(!isset($_GET['month'])) {
  $month = date("Y-m");	
} else {
  $month = $_GET["month"];
}

$result = pg_query($dbconn, "select ch.userid, ch.visiblename  from supporters ch;");
#where exists ( select 1 from supporters_payments cc where ch.userid = cc.userid 
#		and cc.active = 'true'
#		and substr(cc.payment_period, 0, 8) = '".$month."';
if (!$result) {
  echo "{'error':'No result'}";
  exit;
}


$res = new stdClass();
$res->month = $month;
$res->rows = array();
while ($row = pg_fetch_row($result)) {
  $rw = new stdClass();
  array_push($res->rows, $rw);
  $visiblename = $row[1];
  if(!$visiblename || strlen($visiblename) == 0) {
  	  $visiblename = "USER ".$row[0];
  }
  $rw->user = $visiblename;
}

echo json_encode($res);
?>