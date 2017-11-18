<?php
include_once 'db_queries.php';
$res = getRecipients();
$cnt = getCountries();
// "All payments are done from <strong>1GRgEnKujorJJ9VBa76g8cp3sfoWtQqSs4</strong> Bitcoin address. ";
//  "The payouts are distributed based on the ranking which is available on the OSM Contributions tab, the last ranking has weight = 1, the ranking before the last has weight = 2 and so on till the 1st ranking.<br>";
// var rg = recipientRegionName == '' ? 'Worldwide' : recipientRegionName; 
$visibleReg = $res->region;
if($res->region == '') {
    $visibleReg = "Worldwide";
} else {
    for($i = 0; $i < count($cnt->rows); $i++) {
        if($cnt->rows[$i]->downloadname == $res->region) {
            $visibleReg = $cnt->rows[$i]->name;
            break;
        }
    }
}
$month = $res->month;
if(is_null(getReport('getBTCValue'))) {
    $res->message = "<p class='recipients-data-header overview-hint'>Currently collected in <span id='overview-recipients_option'></span> <span id='overview-id' style=\"color:black;float:right;\">Generation date <span>".date("d M Y H:i", $res->date)."</span></span></p>";
    $res->message = $res->message . "<div class='overview overview-btc'><p>" . 
                    number_format($res->btc * 1000, 3) . " mBTC</p><span>total collected (may change in the final report)</span></div>" .
                    "<div class='overview overview-btc'><p>" . 
                    number_format($res->regionBtc*1000, 3) . " mBTC</p><span>collected for {$visibleReg}</span></div>";

} else {
    $res->message = "<p class='recipients-data-header overview-hint'>Totally collected in <span id='overview-recipients_option'></span></p>";
    $res->message = $res->message . "<div class='overview overview-btc'><p>" . 
                    number_format($res->btc * 1000, 3) . " mBTC</p><span>total collected</span></div>" .
                    "<div class='overview overview-btc'><p>"  .
                    number_format($res->regionBtc*1000, 3) . " mBTC</p><span>collected for {$visibleReg}</span></div>";
    $payouts = '';       
    $transactions = json_decode(file_get_contents("transactions.json"), true);
    $transactionsMonth = $transactions[$res->month];
    if($transactionsMonth && $transactionsMonth->transactions) {
        $id = 1;
        foreach ($res->regions as $key) {
            $payouts = $payouts .  '<a href="https://blockchain.info/tx/'.$key.'">Transaction '.$id.'</a>';      
            $id = $id + 1;
        }
    }
    if($payouts != '') {
        $res->message = $res->message . "<p class='recipients-data-header overview-hint'>Payouts:&nbsp;" . $payouts . "</p>";
    }
    $res->message = $res->message . '<p><a type="application/json" href="http://builder.osmand.net/reports/query_month_report.php?report=total&month=' . $res->month . '"  download="report-'. $res->month .'.json" >Download all json reports for ' . $month . ' </a></p>';
}
        
echo json_encode($res);
?>
