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

$result = pg_query($dbconn, "
   SELECT username, ntile(".$ranking_range.") over (order by count(*) desc) nt, count(*) size 
      from changesets ch, changeset_country cc where ch.id = cc.changesetid 
      and substr(ch.closed_at_day, 0, 8) = '".$month."'
      and cc.countryid = (select id from countries where downloadname= '".$_GET['region']."')
      group by ch.username
      having count(*) >= ".$min_changes."
      order by count(*) desc");
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
  $rw->user = $row[0];
  $rw->rank = $row[1];
  $rw->changes = $row[2];
}

echo json_encode($res);
?>