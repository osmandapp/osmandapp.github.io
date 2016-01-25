<?php
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
$min_changes = getMinChanges();
$result = pg_query($dbconn, "
  SELECT  t.username, t.size changes , s.size gchanges FROM
   ( SELECT username, count(*) size 
      from changesets ch, changeset_country cc where ch.id = cc.changesetid 
      and substr(ch.closed_at_day, 0, 8) = '{$month}'
      and cc.countryid = (select id from countries where downloadname= '${region}')
      group by ch.username
      having count(*) >= {$min_changes}
      order by count(*) desc ) t join 
   (SELECT username, count(*) size from changesets ch
    from changesets ch where 
    substr(ch.closed_at_day, 0, 8) = '{$month}'
    group by ch.username
    ) s on s.username = t.username;
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
  $rw->globalchanges = $row[2];
  for($i = 0; $i < count($ar); $i++) {
    if($ar[$i]->min <= $row[1]  && $ar[$i]->max >= $row[1] ){
      $rw->rank = $i + 1;
      break;
    }
  }
  for($i = 0; $i < count($gar); $i++) {
    if($gar[$i]->min <= $row[2]  && $gar[$i]->max >= $row[2] ){
      $rw->grank = $i + 1;
      break;
    }
  }
  
}

echo json_encode($res);
?>