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
$result = pg_query($dbconn, "select id, parentid, downloadname, name, map from countries;");
if (!$result) {
  echo "{'error':'No result'}";
  exit;
}

$res = new stdClass();
$res->rows = array();
while ($row = pg_fetch_row($result)) {
  $rw = new stdClass();
  array_push($res->rows, $rw);
  $rw->id = $row[0];
  $rw->parentid = $row[1];
  $rw->downloadname = $row[2];
  $rw->name = $row[3];
  $rw->map = $row[4];
}

echo json_encode($res);
?>