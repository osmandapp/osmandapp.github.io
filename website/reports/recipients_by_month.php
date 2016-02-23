<?
include_once 'db_queries.php';
$res = getRecipients();
// $cnt = getCountries();
// "All payments are done from <strong>1GRgEnKujorJJ9VBa76g8cp3sfoWtQqSs4</strong> Bitcoin address. ";
//  "The payouts are distributed based on the ranking which is available on the OSM Contributions tab, the last ranking has weight = 1, the ranking before the last has weight = 2 and so on till the 1st ranking.<br>";
// var rg = recipientRegionName == '' ? 'Worldwide' : recipientRegionName; 
$explanation = "All donations are distributed between registered recipients according 
	to their ranking based on the number of changes done in the selected region. 
	Half of donations is distributed between all osm editors and displayed for the 'Worldwide' region. 
	The other half is distributed between osm editors of specific regions which are selected as 'Preferred region' by supporters.";
if(is_null(getReport('getBTCValue'))) {
	$res->message = $explanation;
	$res->message += "<br>Approximate collected sum is <strong>" + 
					($res->btc * 1000.) + "</strong> mBTC in total " +
					"and specially collected for <strong>{$iregion}</strong> region is <strong>"  +
				  	($res->regionBtc*1000.) + "</strong> mBTC.<br>";

} else {
	$res->message = $explanation;
	$res->message += "<br>Collected sum is <strong>" + 
					($res->btc * 1000.) + "</strong> mBTC in total " +
					"and specially collected for <strong>{$iregion}</strong> region is <strong>"  +
				  	($res->regionBtc*1000.) + "</strong> mBTC.<br>";
	if($_REQUEST['month'] == '2016-01') {
		$res->message += 'Payouts: <a href="https://blockchain.info/tx/d5d780bb8171e6438531d4b439d55f6e299c5f70d352ade6db98c7d040baf02c">Transaction #1</a>';
	}
}
        
echo json_encode($res);
?>