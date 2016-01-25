<?php
include 'db_conn.php';

function getRankingRange() {
  return 20;
}

function getMinChanges() {
  return 3;
}

function calculateRanking($imonth, $iregion) {
  $ranking_range = getRankingRange();
  $min_changes = getMinChanges();
	$dbconn = db_conn();
	if (!$dbconn) {
		echo "{'error':'No db connection'}";
		die;
	}
	if(!isset($imonth)) {
  		$month = date("Y-m");	
	} else {
  		$month = $imonth;
	}


if(isset($iregion) && strlen($iregion) > 0) {
  $region =  pg_escape_string($dbconn, $iregion);
  $result = pg_query($dbconn, "
  select data.cnt changes, count(*) group_size
   from (
   SELECT username, count(*) cnt
      from changesets ch, changeset_country cc where 
      substr(ch.closed_at_day, 0, 8) = '{$month}'
      and ch.id = cc.changesetid 
      and cc.countryid = (select id from countries where downloadname= '{$region}')
      group by ch.username
      having count(*) >= ".$min_changes."
      order by count(*) desc
   ) data group by data.cnt order by changes desc;
  ");
} else {
  $result = pg_query($dbconn, "
  select data.cnt changes, count(*) group_size
   from (
   SELECT username, count(*) cnt
      from changesets ch where 
      substr(ch.closed_at_day, 0, 8) = '{$month}'
      group by ch.username
      having count(*) >= ".$min_changes."
      order by count(*) desc
   ) data group by data.cnt order by changes desc;
  ");
}
if (!$result) {
  echo "{'error':'No result'}";
  die;
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

return $ar;
}
?>