<?php
include_once 'db_conn.php';
$dbconn = db_conn();
if (!$dbconn) {
  echo "{'error':'No db connection'}";
  die;
}
if(!isset($_REQUEST['month'])) {
  $imonth = date("Y-m"); 
} else {
  $imonth = $_REQUEST["month"];
}
if(!isset($imonth)) {
  $month = date("Y-m"); 
} else {
  $month = pg_escape_string($dbconn, $imonth);
}

if(!isset($_REQUEST['region'])) {
  $iregion = ''; 
} else {
  $iregion = $_REQUEST['region'];
}

// FUNCTION LIST
// 1st step:
// getTotalChanges - region
// calculateRanking - region
// calculateUsersRanking - region
// [getSupporters, getCountries, getRegionRankingRange, getRankingRange, getMinChanges ]
// 2nd step:
// ! [getBTCEurRate, getBTCValue, getEurValue] !
// FINAL step: 
// ! getRecipients - region

function getRankingRange() {
  return 20;
}

function getRegionRankingRange() {
  return 7;
}

function getMinChanges() {
  return 3;
}

function getReport($name, $ireg = NULL) {
  global  $month, $dbconn;
  if(is_null($ireg)) {
    $rregion = '';
  } else {
    $rregion = pg_escape_string($dbconn, $ireg);
  }
  $result = pg_query($dbconn, "select report from final_reports where month = '${month}'
        and region = '${rregion}' and name='${name}';");
  if (!$result) {
    return NULL;
  }
  $row = pg_fetch_row($result);
  return json_decode($row[0]);
}

function saveReports($res) {
  global  $month, $dbconn;
  for($i = 0; $i < count($res->reports); $i++) {
      $rw = $res->reports[$i];
      if(is_scalar($rw->report)){
        $content = pg_escape_string($dbconn, $rw->report);
      } else {
        $content = pg_escape_string($dbconn, json_encode($rw->report));    
      }    
      $region = pg_escape_string($dbconn, $rw->region);
      $name = pg_escape_string($dbconn, $rw->name);
      $mn = pg_escape_string($dbconn, $rw->month);
      pg_query($dbconn, "delete from final_reports where month = '${mn}' 
        and name = '${name}' and region = '${region}';");
      pg_query($dbconn, "insert into final_reports(month, region, name, report) 
          values('${mn}', '${region}', '${name}', '${content}');");
  }
}

function getTotalChanges() {
  global $iregion, $imonth, $month, $dbconn;
  $finalReport = getReport('getTotalChanges', $iregion);
  if($finalReport != NULL) {
    return $finalReport;
  }

  if(isset($iregion) && strlen($iregion) > 0) {
    $reg =  pg_escape_string($dbconn, $iregion);
    $result = pg_query($dbconn, "select count(distinct ch.username) users, count(distinct ch.id) changes 
        from changesets ch, changeset_country cc where ch.id = cc.changesetid 
        and cc.countryid = (select id from countries where downloadname= '${reg}')
        and substr(ch.closed_at_day, 0, 8) = '".$month."';");
  } else {
    $result = pg_query($dbconn, "select count ( distinct username) users, count(*) changes 
        from changesets
        where substr(closed_at_day, 0, 8) = '".$month."';");
  }
  if (!$result) {
    $res = new stdClass();
    $res->error ='No result';
    return $res;
  }
  
  $res = new stdClass();
  $row = pg_fetch_row($result);
  $res->month = $month;
  $res->users = $row[0];
  $res->changes = $row[1];
  return $res;
}

function calculateRanking($ireg = NULL) {
  global $iregion, $imonth, $month, $dbconn;
  if(is_null($ireg)) {
    $ireg = $iregion;
  }
  $finalReport = getReport('calculateRanking', $ireg);
  if($finalReport != NULL) {
    return $finalReport;
  }

  $min_changes = getMinChanges();
    
  if(isset($ireg) && strlen($ireg) > 0) {
    $region =  pg_escape_string($dbconn, $ireg);
    $ranking_range = getRegionRankingRange();
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
    $ranking_range = getRankingRange();
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
    $res = new stdClass();
    $res->error ='No result';
    return $res;
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
  $res->month = $imonth;
  $res->region = $ireg;
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
  
  return $res;
}


function calculateUsersRanking() {
  global $iregion, $imonth, $month, $dbconn;
  $finalReport = getReport('calculateUsersRanking', $iregion);
  if($finalReport != NULL) {
    return $finalReport;
  }
  $gar = calculateRanking('')->rows;
  $ar = calculateRanking()->rows;
  $region =  pg_escape_string($iregion);
  $min_changes = getMinChanges();
  
    
  $result = pg_query($dbconn, "
    SELECT  t.username, t.size changes , s.size gchanges FROM
     ( SELECT username, count(*) size 
        from changesets ch, changeset_country cc where ch.id = cc.changesetid 
        and substr(ch.closed_at_day, 0, 8) = '{$month}'
        and cc.countryid = (select id from countries where downloadname= '${region}')
        group by ch.username
        having count(*) >= {$min_changes}
        order by count(*) desc ) t join 
     (SELECT username, count(*) size from changesets ch where 
      substr(ch.closed_at_day, 0, 8) = '{$month}'
      group by ch.username
      ) s on s.username = t.username order by t.size desc;
        ");
  if (!$result) {
    $res->error ='No result';
    return $res;
  }
  
  
  $res = new stdClass();
  $res->month = $month;
  $res->rows = array();
  while ($row = pg_fetch_row($result)) {
    $rw = new stdClass();
    array_push($res->rows, $rw);
    $rw->user = $row[0];
    $rw->changes = $row[1];
    $rw->globalchanges = $row[2];
    $rw->rank = '';
    for($i = 0; $i < count($ar); $i++) {
      if($ar[$i]->minChanges <= $row[1]  && $ar[$i]->maxChanges >= $row[1] ){
        $rw->rank = $ar[$i]->rank;
        // $rw->min = $ar[$i]->minChanges ;
        // $rw->max = $ar[$i]->maxChanges ;
        break;
      }
    }
    $rw->grank = '';
    for($i = 0; $i < count($gar); $i++) {
      if($gar[$i]->minChanges <= $row[2]  && $gar[$i]->maxChanges >= $row[2] ){
        $rw->grank = $gar[$i]->rank;
        // $rw->gmin = $gar[$i]->minChanges ;
        // $rw->gmax = $gar[$i]->maxChanges ;

        break;
      }
    }
    
  }
  return $res;

}

function getCountries() {
  global $iregion, $imonth, $month, $dbconn;
  $finalReport = getReport('getCountries');
  if($finalReport != NULL) {
    return $finalReport;
  }
  $result = pg_query($dbconn, "select id, parentid, downloadname, name, map from countries;");
  $res = new stdClass();
  if (!$result) {
    $res->error ='No result';
    return $res;
  }
  $res->rows = array();
  while ($row = pg_fetch_row($result)) {
    $rw = new stdClass();
    array_push($res->rows, $rw);
    $rw->id = $row[0];
    $rw->parentid = $row[1];
    $rw->downloadname = $row[2];
    $rw->name = $row[3];
    $rw->map = $row[4];
  }
  return $res;
}

function getCountryMapName() {
  $rs = getCountries();
  $res = array();
  for ($i = 0; $i < count($rs->rows) ; ++$i) {
    $res[$rs->rows[$i]->downloadname] = $rs->rows[$i]->name;
  }
  return $res;
} 

function getSupporters() {
  global $iregion, $imonth, $month, $dbconn;
  $finalReport = getReport('getSupporters');
  if($finalReport != NULL) {
    return $finalReport;
  }
  $result = pg_query($dbconn, "
    select s.userid, s.visiblename, s.preferred_region, s.useremail, 
    t.sku, t.checktime, t.expiretime, t.starttime, t.autorenewing from supporters s left join 
    (select distinct userid, sku, 
    first_value(checktime) OVER(partition by userid, sku order by checktime desc) checktime,
    first_value(starttime) OVER(partition by userid, sku order by checktime desc) starttime,
    first_value(expiretime) OVER(partition by userid, sku order by checktime desc) expiretime,
    first_value(autorenewing) OVER(partition by userid, sku order by checktime desc) autorenewing
    from supporters_subscription ) t on  
    s.userid = t.userid
    where s.disable is null;
    ");
  if (!$result) {
    $res->error ='No result';
    return $res;
  }
  $countryMap = getCountryMapName();
  
  $res = new stdClass();
  $res->month = $month;
  $res->rows = array();
  $res->notactive = array();
  $res->regions = array();
  $res->regions['']->count = 0;
  $res->regions['']->id = '';
  $res->regions['']->name = 'Worldwide';
  $cnt = 0;
  $active = 0;
  $time = time();
  if($imonth != date("Y-m")) {
    $time = strtotime($imonth."-28"); 
  }
  while ($row = pg_fetch_row($result)) {
    $rw = new stdClass();
    
    $visiblename = $row[1];
    if(!$visiblename || strlen($visiblename) == 0) {
        $visiblename = "User ".$row[0];
    }
    $sku = '';
    $autorenew = '';
    $status = "Not purchased";
    $checked = 0;
    if($row[4] && strlen($row[4]) > 0) {
      $status = "Pending verification";
      $sku = $row[4];
      $skip = false;
      if($row[6]) {
        $checked = $row[5];
        $autorenew = $row[8];
        if($time * 1000 > $row[6]) {
          $status = "Expired " . floor( ($time - $row[6] / 1000) / (3600*24)) . " days ago";
          $skip = ($time - $row[6] / 1000) > 120000;
        } else {
          $status = "Active";
          $res->regions['']->count ++; 
          if(!$row[2]) {
            $res->regions['']->count ++;
          } else {
            if(!array_key_exists($row[2], $res->regions)) {
              $res->regions[$row[2]]->count = 0;
              $res->regions[$row[2]]->id = $row[2];
              if(array_key_exists($row[2], $countryMap)) {
                  $res->regions[$row[2]]->name = $countryMap[$row[2]];
              } else {
                  $res->regions[$row[2]]->name == '';
              }
            }
            $res->regions[$row[2]]->count ++;
          }
          $active++;
        }
      }  
      if($skip) {
        array_push($res->notactive, $rw);
      } else {
        array_push($res->rows, $rw);
      }
    } else {
     array_push($res->notactive, $rw);
    }
  
    $cnt++;
    $rw->user = $visiblename;
    $rw->status = $status;
    $rw->checked = $checked;
    $rw->region = $row[2];
    if(array_key_exists($row[2], $countryMap)) {
      $rw->regionName = $countryMap[$row[2]];
    } else {
       $rw->regionName = '';
    }
    $rw->sku = $sku;
    $rw->autorenew = $autorenew;
  }
  //if(isset($_GET['full']) && $_GET['full'] == true) {
  //  $res->rows = array_merge($res->rows, $res->notactive);
  //}
  $res->count = $cnt;
  $res->activeCount = $active;
  foreach ($res->regions as $key => $value) {
      if($active > 0) {
        $res->regions[$key]->percent = $value->count / (2 * $active);
      } else {
        $res->regions[$key]->percent = 0;
      }
  }
  
  return $res;
}

function getEurValue($activeCount) {
  global $iregion, $imonth, $month, $dbconn;
  $finalReport = getReport('getEurValue');
  if($finalReport != NULL) {
    return $finalReport;
  }
  return $activeCount * 1.2 ; // 1.2 EUR
}

function getBTCValue($eurValue, $rate) {
  global $iregion, $imonth, $month, $dbconn;
  $finalReport = getReport('getBTCValue');
  if($finalReport != NULL) {
    return $finalReport;
  }
  return $eurValue / $rate;
}

function getBTCEurRate() {
  global $iregion, $imonth, $month, $dbconn;
  $finalReport = getReport('getBTCEurRate');
  if($finalReport != NULL) {
    return $finalReport;
  }
  return json_decode(file_get_contents("https://blockchain.info/ticker"))->EUR->sell;
}


function getRecipients($eurValue = NULL, $btc = NULL, $useReport = true ) {
  global $iregion, $imonth, $month, $dbconn;
  $finalReport = getReport('getRecipients', $iregion);
  if($finalReport != NULL && $useReport) {
    return $finalReport;
  }

  $regionName =  pg_escape_string($dbconn, $iregion);
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
    $res->error = 'No result';
    return $res;
  }
  
  $ranking = calculateRanking();
  
  $supporters = getSupporters();

  $res = new stdClass();
  $res->month = $month;
  $res->rows = array();
  $res->region = $regionName;
  $res->regionPercentage = 0;
  if(is_array($supporters->regions)) {
    if(array_key_exists($regionName, $supporters->regions) ) {
      $s = $supporters->regions[$regionName];
      $res->regionPercentage = $s->percent;
    }   
  } else {
    $rr = $regionName == "" ? "_empty_" : $regionName;
    if(property_exists($supporters->regions, $rr) ) {
      $s = $supporters->regions->{$rr};
      $res->regionPercentage = $s->percent;
    } 
  }
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
          $rw->changes <= $ranking->rows[$i]->maxChanges) {
          $rw->rank = $ranking->rows[$i]->rank;
          if($regionName == '') {
              $rw->weight = getRankingRange() + 1 - $rw->rank;
          } else {
             $rw->weight = getRegionRankingRange() + 1 - $rw->rank;
          }
          $totalWeight += $rw->weight;
          break;
        }
      }
  }
  $res->regionCount = $cnt;
  $res->regionTotalWeight = $totalWeight;
  if(is_null($eurValue)) {
    $eurValue = getEurValue($supporters->activeCount);
  }
  $res->eur = $eurValue;
  if(is_null($btc)) {
    $rate = getBTCEurRate();
    $btc = getBTCValue($res->eur, $rate);
  }
  $res->btc = $btc;
  $res->eurRate = $btc > 0 ? $eurValue / $btc : 0;
  $res->regionBtc = $res->regionPercentage * $res->btc;
  for($i = 0; $i < count($res->rows); $i++) {
      $rw = $res->rows[$i];
      if($totalWeight > 0) {
        $rw->btc = $res->regionBtc * $rw->weight / $totalWeight;
      } else {
        $rw->btc = 0;
      }
  }
  return $res;
}

function getAllReportsStage1($res) {
  global $iregion, $imonth, $month, $dbconn;
  $countries = getCountries();

  $rw = new stdClass();
  array_push($res->reports, $rw);
  $rw->name = 'getCountries';
  $rw->month = $imonth;
  $rw->region = '';
  $rw->report = getCountries(); 

  $rw = new stdClass();
  array_push($res->reports, $rw);
  $rw->name = 'getRegionRankingRange';
  $rw->month = $imonth;
  $rw->region = '';
  $rw->report = getRegionRankingRange(); 

  $rw = new stdClass();
  array_push($res->reports, $rw);
  $rw->name = 'getRankingRange';
  $rw->month = $imonth;
  $rw->region = '';
  $rw->report = getRankingRange(); 

  $rw = new stdClass();
  array_push($res->reports, $rw);
  $rw->name = 'getMinChanges';
  $rw->month = $imonth;
  $rw->region = '';
  $rw->report = getMinChanges(); 

  $rw = new stdClass();
  array_push($res->reports, $rw);
  $rw->name = 'getSupporters';
  $rw->month = $imonth;
  $rw->region = '';
  $supporters = getSupporters();
  $rw->report = $supporters; 


  for($i = 0; $i < count($countries->rows); $i++) {
      if($countries->rows[$i]->name == 'World') {
        $iregion = '';
      } else {
        if($countries->rows[$i]->map == '0') {
          continue;
        }
        $iregion = $countries->rows[$i]->downloadname;
      }
      $rw = new stdClass();
      array_push($res->reports, $rw);
      $rw->name = 'calculateUsersRanking';
      $rw->month = $imonth;
      $rw->region = $iregion;
      $rw->report = calculateUsersRanking(); 

      $rw = new stdClass();
      array_push($res->reports, $rw);
      $rw->name = 'calculateRanking';
      $rw->month = $imonth;
      $rw->region = $iregion;
      $rw->report = calculateRanking();

      $rw = new stdClass();
      array_push($res->reports, $rw);
      $rw->name = 'getTotalChanges';
      $rw->month = $imonth;
      $rw->region = $iregion;
      $rw->report = getTotalChanges(); 
  }
  
}

function getAllReports() {
  global $iregion, $imonth, $month, $dbconn;
  $res = new stdClass();
  $res->reports = array();

  // 1st step:
// getTotalChanges - region
// calculateRanking - region
// calculateUsersRanking - region (calculateRanking/reg, calculateRanking/'')
// [getSupporters, getCountries, getRegionRankingRange, getRankingRange, getMinChanges ]
// 2nd step:
// ! [getBTCEurRate, getEurValue, getBTCValue] !
// FINAL step: 
// ! getRecipients - region (calculateRanking, getSupporters)

  if(!isset($_REQUEST['eurValue'])) {
      getAllReportsStage1($res);
  } else {
      $countries = getCountries();
      $res->eurValue = floatval($_REQUEST['eurValue']);
      if(isset($_REQUEST['btcValue'])) {
        $res->btc = floatval($_REQUEST['btcValue']);
        $res->rate = $res->eurValue / $res->btc ;
      } else {
         $res->rate = getBTCEurRate(); 
         $res->btc = $res->eurValue / $res->rate;
      }
      
      $rw = new stdClass();
      array_push($res->reports, $rw);
      $rw->name = 'getEurValue';
      $rw->month = $imonth;
      $rw->region = '';
      $rw->report = $res->eurValue;

      $rw = new stdClass();
      array_push($res->reports, $rw);
      $rw->name = 'getBTCValue';
      $rw->month = $imonth;
      $rw->region = '';
      $rw->report = $res->btc;

      $res->payouts = new stdClass();
      $res->payouts->payoutBTCAvailable = $res->btc;
      $res->payouts->payoutEurAvailable = $res->eurValue;
      $res->payouts->rate = $res->rate;
      $res->payouts->payoutTotal = 0;
      $res->payouts->payments = array();

      $res->payoutTotal = 0;
      for($i = 0; $i < count($countries->rows); $i++) {
          if($countries->rows[$i]->name == 'World') {
             $iregion = '';
          } else {
            if($countries->rows[$i]->map == '0') {
              continue;
            }
            $iregion = $countries->rows[$i]->downloadname;
          }
          
          $rw = new stdClass();
          array_push($res->reports, $rw);
          $rw->name = 'getRecipients';
          $rw->month = $imonth;
          $rw->region = $iregion;
          $rw->report = getRecipients($res->eurValue, $res->btc, false); 
          for($t = 0; $t < count($rw->report->rows); $t++) {
            $rt = $rw->report->rows[$t];          
            if($rt->btc == 0) {
              continue;
            }
            $rs = new stdClass();
            array_push($res->payouts->payments, $rs);
            $rs->btc = $rt->btc;
            $rs->osmid = $rt->osmid;
            $rs->btcaddress = $rt->btcaddress;
            $res->payouts->payoutTotal += $rt->btc;
          }       
      }

      $rw = new stdClass();
      array_push($res->reports, $rw);
      $rw->name = 'getPayouts';
      $rw->month = $imonth;
      $rw->region = '';
      $rw->report = $res->payouts;
  }
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    saveReports($res);
  }
  
  
  return $res;

}

?>