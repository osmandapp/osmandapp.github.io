<?

$val = 100;
$rate = json_decode(file_get_contents("https://blockchain.info/ticker"));
$btc = $val / $rate->EUR->sell;
$res = new stdClass();
$res->eur = $val;
$res->eurRate = $rate->EUR->sell;
$res->btc = $val / $res->eurRate;
echo json_encode($res);
?>