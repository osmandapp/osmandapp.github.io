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
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/5ffdeacb2f6259c12cec8e8ba53cf390ccfd56ffaf480ad4d3c94d859aed669b">Transaction #13</a>';
    } else if($res->month == '2016-10') {
        $payouts = $payouts . '<a href="https://blockchain.info/tx/3c7bac58ea9ce1d4bc088fa118f8099a3fce2849b6db5d7dc278e32f98c7c852">Transaction #1</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/bc359575d4b6f11f195b19627fb4e607a2df8048890e10cceb3b52e08e4d3b4c">Transaction #2</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/7da45458a5def406d8dc7b619cd836b3de5547bf545b0bcf22c248be5dd8e3ff">Transaction #3</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/2d1a370450fb04323541ccbb25113c5aaf501ec3c2421691b807580227e75e6b">Transaction #4</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/0c2a956469f632de1e214bbf27569aa64e2fa1038e3c38a4753d0e515b14e12e">Transaction #5</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/0c566d2f4dff17e59a86f654a12f76b9ddc71cbe66d197a54dbaa6a9848b7f7a">Transaction #6</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/8491e182d5437216ff061b4235f191493184d75605fff663eca59ed1f388da49">Transaction #7</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/2fe20619204a246285460a29bac31fe2d36c097807b0b3547517d1f03553abeb">Transaction #8</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/c225f5e227cd1739c332f7f9df7ccc6dba91d91cd550a0c1126552b48e0db4d8">Transaction #9</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/33ddeba21df823e3c816e7b847b369eadb578c343d5b9f0245b1550df78c176d">Transaction #10</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/fac6009ab743017b59e1fd0d41b86f3c0c05b0b1bb0914726c80a24a35a755ea">Transaction #11</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/ab879d90ab93739bd32c9141951167b95bfdec16fdd3c6985725a3899090dfc2">Transaction #12</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/c954b8dc0f84a083d87e575750766683c9590546da8e93652ec43e913288940c">Transaction #13</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/e56e5e18e0d173deea7cdee97aee9672cbeef66fec94412b4342cb1fe1f3d7fe">Transaction #14</a>';

    } else if($res->month == '2016-11') {
        $payouts = $payouts . '<a href="https://blockchain.info/tx/0c90a96c3647172f465cb42b3c978bc9005e14a7840317e7e0637f2a777beb6c">Transaction #1</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/9bc9a07cfad76dc9d20d606799709560e3081d1c4f9f9bd368225ef52d5447db">Transaction #2</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/cd5d2209471822386ca9be39db6d4fde937aebd2688c1d284a5114432c4aa4b7">Transaction #3</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/f4a559486b6684477b0b4c3d2448d5b01ef35fc185cda6808e8c5e77eb458bd8">Transaction #4</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/7b1d3188ffac9b6766b0aac11c9aff2c9ce8b4a3fc618c52224fa9652829f8cd">Transaction #5</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/85a4ad18813b83f9d73341ad4fc45176f4329afcbce27ce3ec0a03ba8330b754">Transaction #6</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/3cfce99b9b9648a75658e3c4a86bf1bba11fb76eda01618de504b083f304b434">Transaction #7</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/d517fb62c49ec737bb35f73a82718a21f93cb63f82769ed03730b601d4178072">Transaction #8</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/1dc2bf3a64b45e56329356eb664037bd17df47b242696cb3bdf455e065feea11">Transaction #9</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/d50d2e02fb6efd354f06b7657d31b0f737be8f2c2155df1bdad1801bffeb2306">Transaction #10</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/cf0a024b5b139a349be39cf6c1d8452e426e29cea2ef9ee2e5f2fa9bcb614088">Transaction #11</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/37eff4dfd34fc847c374b78a65e13cef6a0c4ebab56ce8380bbccfeb5fc9324a">Transaction #12</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/794e862edcb17ff608a12f02d87694f2e2fd31ca72c1df3464c666053a67485d">Transaction #13</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/8cec76fd911f44752f4dd5d846bcbbb4254a1f982aa3f30690ff09a7980d248d">Transaction #14</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/92df56f859ee20d6acb137a45e686134d1e5a8b2345a08e602c9a7df820c451d">Transaction #15</a>';
        
    } else if($res->month == '2016-12') {
        $payouts = $payouts . '<a href="https://blockchain.info/tx/0bd565147d91f164e629670c440086e4aeab8f263fab62f05cf80c22b4a666a3">Transaction #1</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/6a95d624da4d8680c77811adb6c9a15582e991f0dc3a981104dcec21727f1533">Transaction #2</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/f25a710bdcc6c8bda2b4efdd8ff0b14c6515afae8a51552401c1cf2bba7868f8">Transaction #3</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/530c828c5dc5dfd10e491b881a4d9e7cfd01f13d519c92e3fd4c56e9e8aaef99">Transaction #4</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/454a7fdddf875c7abde71fb1b86581c430a62b55bedb26a17740e6a0c835a445">Transaction #5</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/19adc11797cc8418e5e3336c857ac35a884a140f1df96751d308524518a24363">Transaction #6</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/e218e7635ad7f3fda59fa09ce479208949da6d803c6c279243e632b66ec3e17a">Transaction #7</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/f90810fb662bc181fc3081cffa23ca4e197a59eae75f56f34079006882c30fd9">Transaction #8</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/ea4e611a1f33adcfdeae578d4ce625dc866c832383bd5022679fbd837e247d71">Transaction #9</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/6c40dfaca9034eee4e410c5af2ffe9fc384723464c920fcce4b509e8d32b481f">Transaction #10</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/d92d45d513b447865280982d90cc0cc718ebb8e9b8dc508bd37cf8055a8106d8">Transaction #11</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/5a8a1c765ce0cc9063d4f995da7877d8384c2e6501b308324b5ce7c771574e77">Transaction #12</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/50a1f4c53199d07566c401cc663e56d87a70272e1650beb8dce04336b529eaa0">Transaction #13</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/c524e28108a2d4d558c0446604108f3e170919b22c98b2713b24f4ccbccdd373">Transaction #14</a>';
    
    } else if($res->month == '2017-01') {
        $payouts = $payouts . '<a href="https://blockchain.info/tx/c853828570b08526feb068e52fd08573ec6f8ff9dec9e10bde6cb88fed258169">Transaction #1</a>';  
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/9c58b2e76ba79c2e0f69df0a91c455aa9c0beac6b970de90fe62b5e7b5bcdf43">Transaction #2</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/9e9ec9ade7f797a81ade58b19568956d5c79225ef40989f8a144b297bd13457e">Transaction #3</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/a9ea3146002c3186d5185faddc7d7ae22d614d6fd62d0b44e1944b20fab680e5">Transaction #4</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/da230aa25837f57105813872b1aadebabc9d177aa3cf308ea4e58adabb2da20e">Transaction #5</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/0b9415be61ab8841a4990d3ec3100b8e0cfeaba95b9b5a43ba8d77168445326f">Transaction #6</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/938c0d95aa05eed6dd30734a850af49a8c960c9a5ca4b188ae6472f7a559a185">Transaction #7</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/665d5d331334683ec623af8a4678799a5ec4de28b3053de0ccaa03b2bea8ae58">Transaction #8</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/738a195641e9729f6c96013f69a070d0c56e5c191f897dae612971672e6a7f0c">Transaction #9</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/fa3d48f1fb74cd26299cabe85d9bde93eb6a9215a8602640eb0a9a6b09e6be03">Transaction #10</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/5d3f239572f81e6b735a7b456a4d471024a337eed37558b1e0f89e5c22fba3a9">Transaction #11</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/caad75f8bac3478690a8ddc7dd5797bbe3b2d401574fed10d9a6a4d73f5ba0c3">Transaction #12</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/e208bc32f38c7ce06bbdd72d02e955083d55f803c1b89bb1d06069a7bd834f4b">Transaction #13</a>';
    
    } else if($res->month == '2017-02') {
        $payouts = $payouts . '<a href="https://blockchain.info/tx/cc98ceb89288805feee9106d7cf28c97335f416d2ba475cdd26a4775abd073b1">Transaction #1</a>';  
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/a042b13a269dbe3411eedd3d298db526564e58991b1bf00c1e2f608b572fa48c">Transaction #2</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/b37c0ca729f9981281940fdfd50c8836ab982fe0622df9072204cb4ef2dd97bf">Transaction #3</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/c56a87252ce24b18bb6e2dad5f5ff3e6b791ff5c63aab8aafcd52497eb8b73ed">Transaction #4</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/8c82e3d96c3fa1f5ac75da8b1aff141d6f4451eee3dcec7bad4c1ebca7d4f30d">Transaction #5</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/d643a3dd8a983945fcb634124b05751bf05366bbcea408957b99d03899162f22">Transaction #6</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/2f2e41919a8c1c5cd512222e9e3d5d840c1255d0b75315897cd8ed762bca4cdc">Transaction #7</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/847639ea2c178a6c78bcdbb45d3351fd7bbceabda7b1bad97cb4e5827f79d750">Transaction #8</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/32774f8be818e7aecd7253c415a548bde8ba357324ab6c151849fe4819e82fec">Transaction #9</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/888bead6211494d3ae3eb31ae6ac48e74c9beed8393a020066b6b9931bc02b9e">Transaction #10</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/58edae7cfaf17c646b838a55a155fca07cb110b6946ec41d5519a501c6d6b973">Transaction #11</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/a1709a9796e7d94adea43b373936aabb7a9c2ab9c14288774ddb164fcf522985">Transaction #12</a>'; 
    
    } else if($res->month == '2017-03') {
        $payouts = $payouts . '<a href="https://blockchain.info/tx/194b58e64ee888dd7b9139903f0a9495278f09aad7d7047cd6b30e4f88d4e20d">Transaction #1</a>';  
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/05b0762449bef29718065694acd30a97f6a8ac57025510a9dd9fc23e6a2014b1">Transaction #2</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/7d1ba4adc16e54e55fbc8f19a1d5fa48e04403ddd6a2b402e670a7c7bc82ccf8">Transaction #3</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/2959435acb4b785c0e1d8c2b6caee4c94b7e9820295cd2981eef7fa16823b5e0">Transaction #4</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/4e6963a24d36238d8655461012dd779d6a51139623116711af741f42e79d340e">Transaction #5</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/f1df016f16cebfdfa59cc73a1412efb53a276a356184e73ddbbda58f609e8f0e">Transaction #6</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/cc6a622c317cb1eaf3e60c27daee057a1957c4ec90faed36f996f26593d6fc93">Transaction #7</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/b0785a833510a51e302b4f47a2e41e7a10b5daa34dd503a12886aaf7a3f8f171">Transaction #8</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/9ef3a00301974600fbcb060a756009defaedfd4b180572a40a1296314ae277c5">Transaction #9</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/ec104a41f6bfe734a34db73a8819323461c4cdc897d63330b82597ff8c5bcb3d">Transaction #10</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/03931fef52ef905c43ab9f39ded0a79ac6e38f78a4c906ab634de4b2b3d17887">Transaction #11</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/123562e375cc45a3729d5b3c09990cc82062a6aebad9890c0f7af03b46bcab0b">Transaction #12</a>'; 
    
    } else if($res->month == '2017-04') {
        $payouts = $payouts . '<a href="https://blockchain.info/tx/3842f58f80ce09439b14afbd4059d3450cf71ea667116c66beed22ad2b112937">Transaction #1</a>';  
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/433f05f4ad1bba9a2ea57389f1d20f96c6e738b1c5972dcc1ca920697bc3fa4f">Transaction #2</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/feb9daa8063638c3044ff2d2175f0ff4ebc5f786d65870f8cd4173b67abda71d">Transaction #3</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/9ca386e22fa4e661382d45408557d0ffc0052ba0ac1dab903adeda8ef7b69824">Transaction #4</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/8a1f730ef549ec8c7af873ac330a463fba366f8dc0b7ef579933783214dd5a98">Transaction #5</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/cf10dc8c5a9ef0c63d25384a4257148a46ab16360e79141d4db479b59b617bf1">Transaction #6</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/1e154e383aaafdb335869f60efb9761d15634c2fc0b69c3f4926404eb8d737c1">Transaction #7</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/2b36a072e233c91a1c1ffda61687d4101b36443b58657d6d24bff07f0809873c">Transaction #8</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/7c6fa3a04c242eff7db553e19ef9a8aca0727b671a3966136ff7b1a084965830">Transaction #9</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/f79ce4a46e9bf53053f81022232c288eca277a0c7ebb792fea57910fe2895a45">Transaction #10</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/39f91f952af62b402560323ef898ce4d6dd1642658835369bab6a32b7a962ab7">Transaction #11</a>';
    
    } else if($res->month == '2017-05') {
        $payouts = $payouts . '<a href="https://blockchain.info/tx/bc975fb22eeabfc3ea3ae810e5d96236ec23c2cccc21a57a5e47512e199cf4e2">Transaction #1</a>';  
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/9d9782ba3d36e658488bf063be9b6aa7cb8c7e262885e868a61db388bf8bbe2a">Transaction #2</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/7de3f9a7ca6615f3b0f03846902cdfdc2e4db2f250753df5ffce6ff20affcf6c">Transaction #3</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/8ef748fa8d0183fbff84d7dd8bddf77ac7d9928f53d7853b873e667f79886c83">Transaction #4</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/2f5a7580b582b95f0d65df0f2ae98a6dddcc6041606d17254d55f9b92f393565">Transaction #5</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/2d0dedb1ac210184d61ca7eae011fdaf5a74bb6793daa03131b01264a2d1dac1">Transaction #6</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/b9f4b8bf24f6ef3f5ffc8b1dfc287395eb8a867f94f36a9ad95340fb4824f755">Transaction #7</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://blockchain.info/tx/2f694469ecedd99a34d9d1a53f5e7c4cb8e50cec41b0a0399c43fd3d42a981e6">Transaction #8</a>';
    
    } else if($res->month == '2017-06') {
        $payouts = $payouts . '<a href="https://chain.so/tx/BTC/6cdfcb0cd64de24f0a7d56b0f958d2b4c0e8c7c00c6db68d62e4b74af1a8e392">Transaction #1</a>';        
        $payouts = $payouts . ',&nbsp;<a href="https://chain.so/tx/BTC/5857bebaea7c433d3e46da4937ba6e7b47c343692bd3299d74100347fab2d794">Transaction #2</a>';        
        $payouts = $payouts . ',&nbsp;<a href="https://chain.so/tx/BTC/f808188dc6f0adce1d0852eb0557833b8eea8ace7736b5c37e9d11207d9b4340">Transaction #3</a>';        
        $payouts = $payouts . ',&nbsp;<a href="https://chain.so/tx/BTC/959ed7fc7db082755c54d572090a79ddd0db1a74c51e6a4ab54a7cdff391bfa0">Transaction #4</a>';        
        $payouts = $payouts . ',&nbsp;<a href="https://chain.so/tx/BTC/dc48facc290b0ebb5208536dacb2494b5c6f81f042fcd23aaa0852b616ab57a1">Transaction #5</a>';        
        $payouts = $payouts . ',&nbsp;<a href="https://chain.so/tx/BTC/55f599570f2009ceb7bb7ff9ee8327734fe69fbb32bed5638848a194a3594941">Transaction #6</a>';        
        $payouts = $payouts . ',&nbsp;<a href="https://chain.so/tx/BTC/d966f9fac5729f225c0360deaedba4afdb07aebed8c76a3cea21b89f21b1a43c">Transaction #7</a>';      
        $payouts = $payouts . ',&nbsp;<a href="https://chain.so/tx/BTC/c28667c62dc05997a9f840da538d4bfe42b480cf3f91e37481d5e91ad1539f2f">Transaction #8</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://chain.so/tx/BTC/d966f9fac5729f225c0360deaedba4afdb07aebed8c76a3cea21b89f21b1a43c">Transaction #9</a>';
        
    } else if($res->month == '2017-07') {
        $payouts = $payouts . '<a href="https://chain.so/tx/BTC/0bef67f04a2005e3ba4f50bb8f24e8baebc63246c1ee39cf7374e44f61339351">Transaction #1</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://chain.so/tx/BTC/8db6350177925392f085b0e47542b5113399a03200afcd4403a54520d55668cf">Transaction #2</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://chain.so/tx/BTC/4eb14a0abd390c6b95c7fe65ebd98420bd43d2fed34d26c44a106dbeea8c9af4">Transaction #3</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://chain.so/tx/BTC/8f4421120161625e893621c469d2aefc71bf69b85d3c214ef7aa1695691182e9">Transaction #4</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://chain.so/tx/BTC/3a1aa0b050451b8b406b6ced934b5db49e21fd644f95199a6bf3a808529eb5cf">Transaction #5</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://chain.so/tx/BTC/86161fce0ded4bd2e75ad50d2dacfe56a8d0701c4ad696d37b562417de59d364">Transaction #6</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://chain.so/tx/BTC/6cbd9db3e3a92fe53942b7ddcec5c24ec3362e48003d72f9fdeb3f8ebc7967b6">Transaction #7</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://chain.so/tx/BTC/403e2fd390df42f6db571e27d8659decc7177eb7ee0f04cf084226a4f7723692">Transaction #8</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://chain.so/tx/BTC/7bb0adae8216b1abf0aaec17867846b2e2dfcefc9e57eda03ae8aa3a2df6b11b">Transaction #9</a>';
    
    } else if($res->month == '2017-08') {
        $payouts = $payouts . '<a href="https://chain.so/tx/BTC/b341fe79074d5a38eda51a60aba85b5c974b611ad4eb91a8ebba24aca3233d1a">Transaction #1</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://chain.so/tx/BTC/f0e230f98871136e380ccaad42f2e9ea36d8eb9bca6bd19eccb53671a66697f8">Transaction #2</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://chain.so/tx/BTC/90708fe60245caa0519b3f5ff063b1952394e8a54c74e4adcb4b5b727a39b1a9">Transaction #3</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://chain.so/tx/BTC/f299f4eac6e0801e3c3e3c2088e4ea55b971cae4a5000ef7bd109ba31de20eb4">Transaction #4</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://chain.so/tx/BTC/2677dc233e8d772766fa3fa697191b7ae0c44ff70d3d37666edad9cfb821694d">Transaction #5</a>';
        $payouts = $payouts . ',&nbsp;<a href="https://chain.so/tx/BTC/93f6a0ac87e1bb17fc92cf91525678b1ec5912681e1553e979d76b50534b5219">Transaction #6</a>';
    }

    if($payouts != '') {
        $res->message = $res->message . "<p class='recipients-data-header overview-hint'>Payouts:&nbsp;" . $payouts . "</p>";
    }
    $res->message = $res->message . '<p><a type="application/json" href="http://builder.osmand.net/reports/query_month_report.php?report=total&month=' . $res->month . '"  download="report-'. $res->month .'.json" >Download all json reports for ' . $month . ' </a></p>';
}
        
echo json_encode($res);
?>
