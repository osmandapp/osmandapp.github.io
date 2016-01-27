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

$res = new stdClass();
$res->month = $month;
$res->rows = array();
$res->month = $month;
$res->region = $regionName;
$cnt = 0;
$active = 0;
while ($row = pg_fetch_row($result)) {
  $rw = new stdClass();
  array_push($res->rows, $rw);
  $rw->osmid = $row[0];
  $rw->changes = $row[1];
  $rw->btcaddress = $row[2];
}

$val = 10;
$rate = json_decode(file_get_contents("https://blockchain.info/ticker"));
$btc = $val / $rate->EUR->sell;
$res->eur = $val;
$res->eurRate = $rate->EUR->sell;
$res->btc = $val / $res->eurRate;

echo json_encode($res);
?>