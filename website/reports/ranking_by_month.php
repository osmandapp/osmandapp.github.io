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
  $region =  pg_escape_string($dbconn, $_GET['region']);
  $result = pg_query($dbconn, "
  select data.cnt changes, count(*) group_size
   from (
   SELECT username, count(*) cnt
      from changesets ch, changeset_country cc where ch.id = cc.changesetid 
      where substr(ch.closed_at_day, 0, 8) = '{$month}'
      and cc.countryid = (select id from countries where downloadname= '{$region}')
      group by ch.username
      having count(*) >= {$min_changes}
      order by count(*) desc
   ) data group by data.cnt order by changes desc;
  ");
} else {
  $result = pg_query($dbconn, "
  select data.cnt changes, count(*) group_size
   from (
   SELECT username, count(*) cnt
      from changesets ch
      where substr(ch.closed_at_day, 0, 8) = '{$month}'
      group by ch.username
      having count(*) >= {$min_changes}
      order by count(*) desc
   ) data group by data.cnt order by changes desc;
  ");
}
if (!$result) {
  echo "{'error':'No result'}";
  exit;
}
$ar = array();
while ($row = pg_fetch_row($result)) {
  $rw = new stdClass();
  array_push($ar, $rw);
  $rw->min = $row[0];
  $rw->max = $row[0];
  $rw->count = $row[1];
  $rw->changes = $row[0] * $row[1];
}

while(count($ar) > $ranking_range && count($ar) > 1 ) {
  $minind = 0;
  $minsum = $ar[0]->count + $ar[1]->count;
  for ($i = 1; $i < count($ar) - 1; ++$i) {
     if ( $ar[$i]->count + $ar[$i+1]->count < $minsum) {
         $minind = $i;
         $minsum = $ar[$i]->count + $ar[$i+1]->count;
     }
  }
  $min = min($ar[$minind]->min,$ar[$minind+1]->min);
  $max = max($ar[$minind]->max,$ar[$minind+1]->max);
  $changes =$ar[$minind]->changes + $ar[$minind+1]->changes;
  array_splice($ar, $minind + 1, 1);
  $ar[$minind]->min = $min;
  $ar[$minind]->max = $max;
  $ar[$minind]->count = $minsum;
  $ar[$minind]->changes = $changes;
}

$res = new stdClass();
$res->month = $month;
$res->rows = array();
for ($i = 0; $i < count($ar) ; ++$i) {
  $row = $ar[$i];
  $rw = new stdClass();
  array_push($res->rows, $rw);
  $rw->rank = $i + 1;
  $rw->countUsers = $row->count;
  $rw->minChanges = $row->min;
  $rw->maxChanges = $row->max;
  $rw->avgChanges = $row->changes / $row->count;
}
echo json_encode($res);
?>