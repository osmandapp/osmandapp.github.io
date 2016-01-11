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
$result = pg_query($dbconn, "select nt rank, count (username) people, min(size) min, max(size) max , sum(size) / count(size) avg_changes
from (
	SELECT username, ntile(".$ranking_range.") over (order by count(*) desc) nt, count(*) size FROM changesets 
		where substr(closed_at_day, 0, 8) = '".$month."'
		group by username
		having count(*) >= ".$min_changes."
		order by count(*) desc
	) data
group by nt order by nt asc;");
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
  $rw->rank = $row[0];
  $rw->countUsers = $row[1];
  $rw->minChanges = $row[2];
  $rw->maxChanges = $row[3];
  $rw->avgChanges = $row[4];
}

echo json_encode($res);
?>