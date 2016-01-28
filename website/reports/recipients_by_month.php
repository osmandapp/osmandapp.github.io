<?
include 'db_conn.php';
$dbconn = db_conn();
if (!$dbconn) {
	echo "{'error':'No db connection'}";
	exit;
}
if(!isset($_GET['month']) or $_GET['month'] == '') {
  $month = date("Y-m");	
} else {
  $month = $_GET["month"];
}
$regionName = array_key_exists('region', $_GET) ? $_GET['region'] : '';
$region =  pg_escape_string($dbconn, $regionName);

$result = pg_query($dbconn, "
	select distinct s.osmid, t.size changes,
	 first_value(s.btcaddr) over (partition by osmid order by updatetime desc) btcaddr
    from osm_recipients s left join 
	(select count(*) size, ch.username
      from changesets ch".
      ($regionName == ""? " where " : ", changeset_country cc where ch.id = cc.changesetid  and ").
       " substr(ch.closed_at_day, 0, 8) = '${month}' ".
	  ($regionName == "" ? "" :" and cc.countryid = (select id from countries where downloadname= '{$regionName}') ").
      " group by username) t 
    on t.username = s.osmid ".
  ($regionName == "" ? "" :" where t.size is not null ").
	" order by changes desc");
if (!$result) {
  echo "{'error':'No result'}";
  exit;
}
$ranking = json_decode(
	file_get_contents("query_report.php?report=ranking_by_month&month={$month}&region={$regionName}"));


$res = new stdClass();
$res->month = $month;
$res->rows = array();
$res->month = $month;
$res->region = $regionName;
$cnt = 0;
$totalWeight = 0;
while ($row = pg_fetch_row($result)) {
  $rw = new stdClass();
  array_push($res->rows, $rw);
  $rw->osmid = $row[0];
  $rw->changes = $row[1];
  $rw->btcaddress = $row[2];
  $rw->rank = 0;
  $rw->weight = 0;
  $cnt ++;
  for ($i = 0; $i < count($ranking->rows) ; ++$i) {
  	if($rw->changes >= $ranking->rows[$i]->minChanges and 
  		$rw->changes >= $ranking->rows[$i]->maxChanges) {
  		$rw->rank = $ranking->rows[$i]->rank;
  		if($regionName == '') {
  	    	$rw->weight = getRankingRange() + 1 - $rw->rank;
  	    } else {
  	    	$rw->weight = getRegionRankingRange() + 1 - $rw->rank;
  	    }
  	    $totalWeight += $rw->weight;
  	}
  }
}

$val = 10;
$rate = json_decode(file_get_contents("https://blockchain.info/ticker"));
$btc = $val / $rate->EUR->sell;
$res->eur = $val;
$res->cnt = $cnt;
$res->totalWeight = $totalWeight;
$res->eurRate = $rate->EUR->sell;
$res->btc = $val / $res->eurRate;

echo json_encode($res);
?>