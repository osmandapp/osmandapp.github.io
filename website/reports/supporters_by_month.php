<?php

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
  echo "{'error':'No result'}";
  exit;
}



$res = new stdClass();
$res->month = $month;
$res->rows = array();
$res->notactive = array();
$cnt = 0;
$active = 0;
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
	  if($row[6]) {
		 $checked = $row[5];
		 $autorenew = $row[8];
		 if(time() * 1000 > $row[6]) {
		 	$status = "Expired";
		 } else {
		 	$status = "Active";
		 	$active++;
		 }
	  }	
	 array_push($res->rows, $rw);
  } else {
	 array_push($res->notactive, $rw);
  }

  $cnt++;
  $rw->user = $visiblename;
  $rw->status = $status;
  $rw->checked = $checked;
  $rw->region = $row[2];
  $rw->sku = $sku;
  $rw->autorenew = $autorenew;
}
//if(isset($_GET['full']) && $_GET['full'] == true) {
//	$res->rows = array_merge($res->rows, $res->notactive);
//}
$res->count = $cnt;
$res->activeCount = $active;

echo json_encode($res);
?>