<?
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
    $res->message = "<p class='recipients-data-header overview-hint'>Currently collected in <span id='overview-recipients_option'></span> </p>";
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
    if($res->month == '2016-01') {
        $payouts = $payouts . '<a href="https://blockchain.info/tx/d5d780bb8171e6438531d4b439d55f6e299c5f70d352ade6db98c7d040baf02c">Transaction #1</a>';
    } else if($res->month == '2016-02') {
        $payouts = $payouts . '<a href="https://blockchain.info/tx/8158da594891265e36ec2ba531061e7edcde27e2a46b459c9019bfa280b2cf85">Transaction #1</a>';
    } else if($res->month == '2016-03') {
        $payouts = $payouts . '<a href="https://blockchain.info/tx/3972ae6a30ed4a97f3b448f5bef360e6ca9858dec4e2c1fce4d5971b0897823e">Transaction #1</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/3f1fc2d9bd0abc184d77d5457c915ed5252bce21dfda0299347fee863423ee73">Transaction #2</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/b86aa1773e2c256da33632c725b1d5c5227aad406bff5fbf27924c30298ec426">Transaction #3</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/513f7ada01e01cbb56f87ea8d70c8da4e3b8c9e49e19c44813f7a56669b499d3">Transaction #4</a>';
    } else if($res->month == '2016-04') {
        $payouts = $payouts . '<a href="https://blockchain.info/tx/811fe35729272a754178c6d385a31f5604f1f3c97126ed90f7ead0f93c60ca2f">Transaction #1</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/1b3a2ad4498882b70f117bb7a2f4ed01fcf0b55d8b734a4710c1530c3b7e9ac">Transaction #2</a>';
    } else if($res->month == '2016-05') {
        $payouts = $payouts . '<a href="https://blockchain.info/tx/c68717df1663a87bb91a540c05989db645cb94e89b508457322bd1393c4ccda0">Transaction #1</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/1df5e24f3edb0ce6932be78f23293cca7d1c54a5ef1d8506ac2f4205cb4bfdfd">Transaction #2</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/6f1365a832456c60259ca77dabb1b02b7db51cd22aa58e8036f46962a997c6d2">Transaction #3</a>';
    } else if($res->month == '2016-06') {
        $payouts = $payouts . '<a href="https://blockchain.info/tx/423f91fb54b909f0a79372cc921b35a78b894d0a7e0113cf8fd540569837f63d">Transaction #1</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/1468dc62e9442676847be035a6b2dc939cc3a9f995e3aae0c4ea03b8f8b76196">Transaction #2</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/7c0e8db39121b0282082398a62cafadcee6e5b705a1eb1b1989c9eb709fe224a">Transaction #3</a>';
    } else if($res->month == '2016-07') {
        $payouts = $payouts . '<a href="https://blockchain.info/tx/0638dcac87566cbb5f17c02f13d9c31cb78bc75435f4a654a924bf5b833884f8">Transaction #1</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/c0eef69d6d67a77617a3c716b0e13db49aff85868fe6b6fa2dec2122ec8bd22f">Transaction #2</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/1614be05444686ba2729751a839dae1e75b1c08ac737d9e0b2262ff0b4f2f616">Transaction #3</a>';
    } else if($res->month == '2016-08') {
        $payouts = $payouts . '<a href="https://blockchain.info/tx/93a73aa0c0f8b10394aecece4b5c9e6ab10bf65ef689e4f199b2bf231912bb56">Transaction #1</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/7e39fac96604b0a2f95693b930a73485150b0b6c4f08688340444b072a3de86c">Transaction #2</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/f552bd411d956712968a84241e5c4f99dd2836a453a7e2a07737592183d20740">Transaction #3</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/997cc7abb59fab180fd7f264ca83d92c9ac9b92d250372faa930f74fe22ceadc">Transaction #4</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/beb8f9399aabded66351fcac6b15286c2737b0790b935a56b2ad23a63e788dbd">Transaction #5</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/2deb7c2bbc45c6f4a41102b5668d743dfab5cb1ea9edf49fe79b2586d99c92a4">Transaction #6</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/2fb8aba1f0c27a6034e2a80cea476769f249ddd37366b39b159c754be6b0ecb6">Transaction #7</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/71e0e2afa11194621bded3c0d873fe345919f660f8faa00401aa3e0fe04a6b3c">Transaction #8</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/ddf636f2ea2e5079de7b83fa04e2e635b35a127c2dbd9b05e740088ee11b893e">Transaction #9</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/f634db24b777a4bedc2deb739bdcc292a90673f35420c0cf35df020edc7b1af8">Transaction #10</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/2819eb8afc9fcda4738995d3fbdf9958191a58e3e9be9cc589dd797f8a432d85">Transaction #11</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/309d3b9dfa24d352adb8aa003cdf9691824f1fa5ad087cd9b01be32dea01864f">Transaction #12</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/d83ec200b3f10d5d9a7e8e3974403aa1e14de001f363902bc306e82cc7b16845">Transaction #13</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/4539454612e73129b8d83e49e7df86e70c146d5781e1bef093da09a94ce63f79">Transaction #14</a>';
    } else if($res->month == '2016-09') {
        $payouts = $payouts . '<a href="https://blockchain.info/tx/b161d41c61d3063067ed3c60c1513f5be6bb6368554aa0ae3ed0943a2cf939a3">Transaction #1</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/2f6b0b92eedeb8bfaa9675879cd2d1297da297096829b547aa02d90a2bd8a52c">Transaction #2</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/ff4ff04f3bfa443a912ddb00c6cd42d13d718328905d001b5af772934abf746f">Transaction #3</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/255cf1cc32eb9da7ef10877ea38d239046c0055f19790dfb6227d8d17240315a">Transaction #4</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/644f954da645833814d9d01d76194a4dfc1ee02f4595102c13728fa9b469000e">Transaction #5</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/a68f3ecacdd2c8891a119f541b1b3494a5ac5afc1cd3bba07ffacef96fcf825f">Transaction #6</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/018a6df39fc3ff4dbaeab7a34c67aa5bf7a311bf5665237466ec64956e512bd4">Transaction #7</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/99dd5f45d878372364f283328f2d03da79a7e800293df559834c2bf07c47cb82">Transaction #8</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/949c6dbb750933fcdec4c88cf13bb778b55e749994e5b45579dbf72318cc850f">Transaction #9</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/a35193847c1635c901ab8f6e0f28e28f5b0da9ff19a379ec49c0c4c44de81100">Transaction #10</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/cd1c091f47a7b55a340abd00937c303fdbe8535bb5ec7e22d7938b72ba9fdf6d">Transaction #11</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/dd126b052ccaa5db8bb10c027620dcf8a8da33fcc62fbf6bbe0eed211c2fc1d4">Transaction #12</a>';
    }
    if($payouts != '') {
        $res->message = $res->message . "<p class='recipients-data-header overview-hint'>Payouts:&nbsp;" . $payouts . "</p>";
    }
    $res->message = $res->message . '<p><a type="application/json" href="http://builder.osmand.net/reports/query_month_report.php?report=total&month=' . $res->month . '"  download="report-'. $res->month .'.json" >Download all json reports for ' . $month . ' </a></p>';
}
        
echo json_encode($res);
?>
