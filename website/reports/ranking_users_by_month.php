<?php
include 'db_conn.php';
include 'default_vars.php';
include 'calculate_ranking.php';

$dbconn = db_conn();
if (!$dbconn) {
	echo "{'error':'No db connection'}";
	exit;
}

$gar = calculateRanking($_GET['month'], '');
$ar = calculateRanking($_GET['month'], $_GET['region']);
if(!isset($_GET['month'])) {
  $month = date("Y-m");	
} else {
  $month = $_GET["month"];
}
$region =  pg_escape_string($dbconn, $_GET['region']);

$result = pg_query($dbconn, "
   SELECT username, count(*) size 
      from changesets ch, changeset_country cc where ch.id = cc.changesetid 
      and substr(ch.closed_at_day, 0, 8) = '{$month}'
      and cc.countryid = (select id from countries where downloadname= '${region}')
      group by ch.username
      having count(*) >= ".$min_changes."
      order by count(*) desc
      ");
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
  $rw->changes = $row[1];
  for($i = 0; $i < count($ar); $i++) {
    if($ar[$i]->min <= $row[1]  && $ar[$i]->max >= $row[1] ){
      $rw->rank = $i + 1;
      break;
    }
  }
  for($i = 0; $i < count($gar); $i++) {
    if($gar[$i]->min <= $row[1]  && $gar[$i]->max >= $row[1] ){
      $rw->grank = $i + 1;
      break;
    }
  }
  
}

echo json_encode($res);
?>