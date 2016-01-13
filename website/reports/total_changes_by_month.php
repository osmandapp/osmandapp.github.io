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
if(isset($_GET['region']) && strlen($_GET['region']) > 0) {
	$result = pg_query($dbconn, "select count(distinct ch.username) users, count(distinct ch.id) changes 
			from changesets ch, changeset_country cc where ch.id = cc.changesetid 
			and cc.countryid = (select id from countries where downloadname= '".$_GET['region']."')
			and substr(ch.closed_at_day, 0, 8) = '".$month."';");
} else {
	$result = pg_query($dbconn, "select count ( distinct username) users, count(*) changes 
			from changesets
			where substr(closed_at_day, 0, 8) = '".$month."';");
}
if (!$result) {
  echo "{'error':'No result'}";
  exit;
}

$res = new stdClass();
$row = pg_fetch_row($result);
$res->month = $month;
$res->users = $row[0];
$res->changes = $row[1];

echo json_encode($res);
?>