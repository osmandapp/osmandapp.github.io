<?
include 'db_conn.php';
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
	select distinct s.osmid,
	    first_value(s.btcaddr) over (partition by osmid order by updatetime desc) btcaddr
	    from osm_recipients s;
	");
if (!$result) {
  echo "{'error':'No result'}";
  exit;
}

$res = new stdClass();
$res->month = $month;
$res->rows = array();
$cnt = 0;
$active = 0;
while ($row = pg_fetch_row($result)) {
  $rw = new stdClass();
  array_push($res->rows, $rw);
  $rw->osmid = $row[0];
  $rw->btcaddress = $row[1];
}

$val = 100;
$rate = json_decode(file_get_contents("https://blockchain.info/ticker"));
$btc = $val / $rate->EUR->sell;
$res->eur = $val;
$res->eurRate = $rate->EUR->sell;
$res->btc = $val / $res->eurRate;

echo json_encode($res);
?>